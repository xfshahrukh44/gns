<?php

use App\Models\AuthorWebsite;
use App\Models\BookCover;
use App\Models\BookFormatting;
use App\Models\Bookprinting;
use App\Models\BookWriting;
use App\Models\Client;
use App\Models\ContentWritingForm;
use App\Models\Invoice;
use App\Models\Isbnform;
use App\Models\LogoForm;
use App\Models\NoForm;
use App\Models\ProductionMemberAssign;
use App\Models\Project;
use App\Models\Proofreading;
use App\Models\SeoForm;
use App\Models\SmmForm;
use App\Models\Task;
use App\Models\User;
use App\Models\WebForm;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

function remove_image_bg ($url) {
    $apiKey = 'WvWbX6ydJMwVfmsWMRRD6suC'; // Replace with your remove.bg API key
    $imageUrl = $url;

    // Initialize cURL session
    $ch = curl_init();

    // Set the URL and options for the cURL request
    curl_setopt($ch, CURLOPT_URL, 'https://api.remove.bg/v1.0/removebg');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'image_url' => $imageUrl,
        'size' => 'auto'
    ]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-Api-Key: ' . $apiKey
    ]);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for errors
    if(curl_errno($ch)) {
        return $url;
    }

    // Close the cURL session
    curl_close($ch);

    // Save the processed image
    $image_name = explode(DIRECTORY_SEPARATOR, $imageUrl);
    $image_name = $image_name[count($image_name) - 1];
    $chunks = explode('.', $image_name);
    $image_name = $chunks[0];
    $extension = $chunks[1];
    $processedImage = $image_name . '.' . $extension;
    file_put_contents($processedImage, $response);
}