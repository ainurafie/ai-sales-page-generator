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
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => $this->appUrl,
                'X-OpenRouter-Title' => $this->appName,
            ])
                ->timeout(60)
                ->post($this->baseUrl . '/chat/completions', [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Kamu adalah copywriter profesional yang membuat sales page berbahasa Indonesia yang jelas, persuasif, dan siap dipakai.',
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt,
                        ],
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 2000,
                ]);

            if (!$response->successful()) {
                Log::error('OpenRouter API Error', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                ]);

                return [
                    'success' => false,
                    'message' => 'Gagal generate sales page dari OpenRouter.',
                    'content' => null,
                    'error' => $response->json(),
                ];
            }

            $result = $response->json();

            $content = $result['choices'][0]['message']['content'] ?? null;

            if (!$content) {
                return [
                    'success' => false,
                    'message' => 'Response OpenRouter tidak memiliki content.',
                    'content' => null,
                    'raw' => $result,
                ];
            }

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

    private function buildPrompt(array $data): string
    {
        $productName = $data['product_name'] ?? '-';
        $description = $data['description'] ?? '-';
        $features = $data['features'] ?? '-';
        $targetAudience = $data['target_audience'] ?? '-';
        $price = $data['price'] ?? '-';
        $usp = $data['usp'] ?? '-';

        return <<<PROMPT
Buatkan sales page lengkap berdasarkan data berikut:

Nama produk / layanan:
{$productName}

Deskripsi:
{$description}

Fitur utama:
{$features}

Target audience:
{$targetAudience}

Harga:
{$price}

Unique selling point:
{$usp}

Format output wajib:

1. Headline utama
2. Subheadline
3. Opening section
4. Problem section
5. Solution section
6. Benefit section dalam bullet point
7. Why choose us
8. Offer / harga
9. Call to action
10. FAQ singkat

Gunakan bahasa Indonesia yang natural, jelas, dan menjual.
Jangan terlalu hiperbola.
Jangan pakai placeholder.
PROMPT;
    }
}