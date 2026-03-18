<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZhipuAIService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://open.bigmodel.cn/api/paas/v4/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.zhipuai.key') ?? env('ZHIPUAI_API_KEY');
    }

    /**
     * Generate JWT for Zhipu AI authentication.
     */
    protected function generateToken(): string
    {
        $parts = explode('.', $this->apiKey);
        if (count($parts) !== 2) {
            throw new \Exception('Invalid ZhipuAI API Key format.');
        }

        [$id, $secret] = $parts;
        $timestamp = time() * 1000;
        $exp = $timestamp + 3600000; // 1 hour

        $header = $this->base64UrlEncode(json_encode(['alg' => 'HS256', 'sign_type' => 'SIGN']));
        $payload = $this->base64UrlEncode(json_encode([
            'api_key' => $id,
            'exp' => $exp,
            'timestamp' => $timestamp
        ]));

        $signature = hash_hmac('sha256', "$header.$payload", $secret);
        
        return "$header.$payload.$signature";
    }

    protected function base64UrlEncode(string $data): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    /**
     * Get suggestions from GLM-4.
     */
    public function getSuggestions(string $systemPrompt, string $userPrompt): ?array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->generateToken(),
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl, [
                'model' => 'glm-4-flash', // Economic and fast
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $userPrompt],
                ],
                'response_format' => ['type' => 'json_object'],
            ]);

            if ($response->successful()) {
                $content = $response->json('choices.0.message.content');
                return json_decode($content, true);
            }

            Log::error('ZhipuAI Error: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('ZhipuAI Exception: ' . $e->getMessage());
            return null;
        }
    }
}
