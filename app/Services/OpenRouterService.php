<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenRouterService
{
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;
    protected string $appUrl;
    protected string $appName;

    public function __construct()
    {
        $this->apiKey = config('services.openrouter.api_key');
        $this->baseUrl = rtrim(config('services.openrouter.base_url'), '/');
        $this->model = config('services.openrouter.model');
        $this->appUrl = config('services.openrouter.app_url');
        $this->appName = config('services.openrouter.app_name');
    }

    public function generateSalesPage(array $data): array
    {
        if (!$this->apiKey) {
            return [
                'success' => false,
                'message' => 'OPENROUTER_API_KEY belum diisi di file .env',
                'content' => null,
            ];
        }

        $prompt = $this->buildPrompt($data);

        try {
            $payload = [
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Kamu adalah copywriter profesional yang membuat sales page berbahasa Indonesia. Selalu balas HANYA dalam format JSON valid tanpa markdown, tanpa code block, tanpa penjelasan tambahan.',
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
                'temperature' => 0.7,
                'max_tokens' => 4000,
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => $this->appUrl,
                'X-Title' => $this->appName,
            ])
                ->timeout(120)
                ->post($this->baseUrl . '/chat/completions', $payload);

            if (!$response->successful()) {
                Log::error('OpenRouter API Error', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                ]);

                $errorMsg = data_get($response->json(), 'error.message', 'Gagal generate sales page dari OpenRouter.');

                return [
                    'success' => false,
                    'message' => 'OpenRouter Error: ' . $errorMsg,
                    'content' => null,
                    'error' => $response->json(),
                ];
            }

            $result = $response->json();

            // Extract content from various possible response shapes
            $content = data_get($result, 'choices.0.message.content')
                ?? data_get($result, 'choices.0.message.reasoning_content')
                ?? data_get($result, 'choices.0.text')
                ?? data_get($result, 'choices.0.delta.content')
                ?? null;

            if (!$content) {
                Log::error('OpenRouter Empty Content', ['response' => $result]);

                $finishReason = data_get($result, 'choices.0.finish_reason', 'unknown');
                $providerError = data_get($result, 'error.message');

                return [
                    'success' => false,
                    'message' => $providerError
                        ? 'OpenRouter Error: ' . $providerError
                        : 'Response OpenRouter kosong (finish_reason: ' . $finishReason . '). Cek storage/logs/laravel.log atau coba ganti OPENROUTER_MODEL di .env.',
                    'content' => null,
                    'raw' => $result,
                ];
            }

            // Clean content from markdown code fences if AI wraps JSON in ```json ... ```
            $content = $this->stripCodeFence($content);

            return [
                'success' => true,
                'message' => 'Sales page berhasil dibuat.',
                'content' => $content,
                'raw' => $result,
            ];
        } catch (\Throwable $e) {
            Log::error('OpenRouter Exception', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi error saat menghubungi OpenRouter: ' . $e->getMessage(),
                'content' => null,
            ];
        }
    }

    private function stripCodeFence(string $content): string
    {
        $content = trim($content);

        if (preg_match('/^```(?:json)?\s*(.*?)\s*```$/s', $content, $matches)) {
            return trim($matches[1]);
        }

        return $content;
    }

    private function buildPrompt(array $data): string
    {
        $productName = $data['product_name'] ?? '-';
        $description = $data['description'] ?? '-';
        $features = $data['features'] ?? '-';
        $targetAudience = $data['target_audience'] ?? '-';
        $price = $data['price'] ?? '-';
        $usp = $data['usp'] ?? '-';

        return <<<PROMPT
Buatkan konten sales page untuk produk berikut:

Nama produk: {$productName}
Deskripsi: {$description}
Fitur utama: {$features}
Target audience: {$targetAudience}
Harga: {$price}
Unique selling point: {$usp}

Balas HANYA dalam format JSON valid (tanpa markdown, tanpa code block) dengan struktur PERSIS seperti ini:

{
  "hero": {
    "headline": "Headline utama yang kuat dan menarik (max 12 kata)",
    "subheadline": "Subheadline pendukung yang menjelaskan value proposition (1-2 kalimat)",
    "cta_text": "Teks tombol CTA utama (contoh: Mulai Sekarang)"
  },
  "problem": {
    "title": "Judul section problem",
    "description": "Paragraf yang menggambarkan masalah utama target audience (2-3 kalimat)",
    "points": ["Pain point 1", "Pain point 2", "Pain point 3", "Pain point 4"]
  },
  "solution": {
    "title": "Judul section solusi",
    "description": "Paragraf yang menjelaskan bagaimana produk menjadi solusi (2-3 kalimat)"
  },
  "features": [
    {"icon": "zap", "title": "Nama fitur 1", "description": "Penjelasan singkat fitur (1-2 kalimat)"},
    {"icon": "shield", "title": "Nama fitur 2", "description": "Penjelasan singkat fitur (1-2 kalimat)"},
    {"icon": "chart", "title": "Nama fitur 3", "description": "Penjelasan singkat fitur (1-2 kalimat)"},
    {"icon": "users", "title": "Nama fitur 4", "description": "Penjelasan singkat fitur (1-2 kalimat)"}
  ],
  "benefits": [
    "Manfaat 1 yang konkret bagi customer",
    "Manfaat 2 yang konkret bagi customer",
    "Manfaat 3 yang konkret bagi customer",
    "Manfaat 4 yang konkret bagi customer",
    "Manfaat 5 yang konkret bagi customer"
  ],
  "why_us": {
    "title": "Kenapa pilih kami",
    "reasons": [
      {"title": "Alasan 1", "description": "Penjelasan alasan"},
      {"title": "Alasan 2", "description": "Penjelasan alasan"},
      {"title": "Alasan 3", "description": "Penjelasan alasan"}
    ]
  },
  "testimonials": [
    {"name": "Nama lengkap fiktif realistis", "role": "Pekerjaan/posisi", "quote": "Testimoni 2-3 kalimat yang natural dan kredibel"},
    {"name": "Nama lengkap fiktif realistis", "role": "Pekerjaan/posisi", "quote": "Testimoni 2-3 kalimat yang natural dan kredibel"},
    {"name": "Nama lengkap fiktif realistis", "role": "Pekerjaan/posisi", "quote": "Testimoni 2-3 kalimat yang natural dan kredibel"}
  ],
  "pricing": {
    "title": "Penawaran spesial",
    "price": "{$price}",
    "original_price": "Harga coret jika ada (boleh kosong)",
    "includes": ["Yang didapat 1", "Yang didapat 2", "Yang didapat 3", "Yang didapat 4"],
    "cta_text": "Teks tombol CTA pricing"
  },
  "faq": [
    {"question": "Pertanyaan 1?", "answer": "Jawaban 1"},
    {"question": "Pertanyaan 2?", "answer": "Jawaban 2"},
    {"question": "Pertanyaan 3?", "answer": "Jawaban 3"},
    {"question": "Pertanyaan 4?", "answer": "Jawaban 4"}
  ],
  "final_cta": {
    "headline": "Headline closing yang persuasif",
    "description": "Kalimat penutup yang mendorong action",
    "cta_text": "Teks tombol CTA final"
  }
}

Untuk field "icon", pilih HANYA dari: zap, shield, chart, users, star, heart, rocket, check, clock, trophy.
Gunakan bahasa Indonesia yang natural, jelas, dan menjual. Jangan hiperbola. Jangan pakai placeholder.
PROMPT;
    }
}