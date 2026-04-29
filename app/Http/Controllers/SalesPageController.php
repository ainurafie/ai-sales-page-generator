<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalesPageRequest;
use App\Models\SalesPage;
use App\Services\OpenRouterService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SalesPageController extends Controller
{
    use AuthorizesRequests;

    protected OpenRouterService $openRouterService;

    public function __construct(OpenRouterService $openRouterService)
    {
        $this->openRouterService = $openRouterService;
    }

    public function index()
    {
        $salesPages = auth()->user()->salesPages()->latest()->get();

        return view('sales-pages.index', compact('salesPages'));
    }

    public function create()
    {
        return view('sales-pages.create');
    }

    public function store(StoreSalesPageRequest $request)
    {
        $validated = $request->validated();

        $aiResult = $this->openRouterService->generateSalesPage($validated);

        if (!$aiResult['success']) {
            return back()
                ->withInput()
                ->withErrors([
                    'ai' => $aiResult['message'] ?? 'Gagal generate sales page.',
                ]);
        }

        $salesPage = auth()->user()->salesPages()->create([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'],
            'features' => $validated['features'],
            'target_audience' => $validated['target_audience'],
            'price' => $validated['price'] ?? null,
            'usp' => $validated['usp'] ?? null,
            'generated_content' => $aiResult['content'],
        ]);

        return redirect()
            ->route('sales-pages.show', $salesPage)
            ->with('success', 'Sales page berhasil dibuat.');
    }

    public function show(SalesPage $salesPage)
    {
        $this->authorize('view', $salesPage);

        $content = json_decode($salesPage->generated_content ?? '', true);

        if (!is_array($content)) {
            $content = null;
        }

        return view('sales-pages.show', compact('salesPage', 'content'));
    }

    public function export(SalesPage $salesPage)
    {
        $this->authorize('view', $salesPage);

        $content = json_decode($salesPage->generated_content ?? '', true);

        if (!is_array($content)) {
            return back()->withErrors([
                'export' => 'Konten tidak valid untuk di-export.',
            ]);
        }

        $html = view('sales-pages.export', compact('salesPage', 'content'))->render();

        $filename = \Illuminate\Support\Str::slug($salesPage->product_name) . '.html';

        return response($html, 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function destroy(SalesPage $salesPage)
    {
        $this->authorize('delete', $salesPage);

        $salesPage->delete();

        return redirect()
            ->route('sales-pages.index')
            ->with('success', 'Sales page berhasil dihapus.');
    }
}