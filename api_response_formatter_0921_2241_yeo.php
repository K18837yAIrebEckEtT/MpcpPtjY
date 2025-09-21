<?php
// 代码生成时间: 2025-09-21 22:41:33
class ApiResponseFormatter {

    /**
     * Format the API response
     *
     * @param array $data Data to be formatted into the API response
     * @param int $statusCode HTTP status code
     * @param string|null $message Optional message to include in the response
     * @return string JSON formatted API response
     */
    public function formatResponse(array $data, int $statusCode, string $message = null): string {

        // Initialize the response array
        $response = [
            'status' => 'success',
            'statusCode' => $statusCode,
            'data' => $data
        ];

        // If a message is provided, add it to the response
        if ($message !== null) {
            $response['message'] = $message;
        }

        // Return the response as a JSON string
        return json_encode($response);
    }

    /**
     * Format an error response
     *
     * @param int $statusCode HTTP status code
     * @param string $message Error message
     * @return string JSON formatted error response
     */
    public function formatErrorResponse(int $statusCode, string $message): string {

        // Initialize the error response array
        $errorResponse = [
            'status' => 'error',
            'statusCode' => $statusCode,
            'message' => $message
        ];

        // Return the error response as a JSON string
        return json_encode($errorResponse);
    }
}

// Usage example
$responseFormatter = new ApiResponseFormatter();

// Success response
$successResponse = $responseFormatter->formatResponse(['key' => 'value'], 200);
echo $successResponse;

// Error response
$errorResponse = $responseFormatter->formatErrorResponse(400, 'Bad Request');
echo $errorResponse;
