<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Blog;

class RSSController extends Controller
{
    public function generateRSS()
    {
        // Fetch blog data from the 'blogs' table
        $blogs = Blog::latest()->get();

        // Fetch APP_URL and APP_NAME from the configuration
        $appUrl = config('app.url');
        $appName = config('app.name');

        // Start building the RSS content
        $rssContent = <<<EOT
            <?xml version="1.0" encoding="UTF-8" ?>
            <rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
                <channel>
                    <title>{$appName} RSS Feed</title>
                    <link>{$appUrl}</link>
                    <description>Latest blogs from {$appName}</description>
            EOT;
            
                    // Dynamically add each blog item
                    foreach ($blogs as $blog) {
                        $blogUrl = route('blog-details', ['slug' => $blog->slug]); // Use route name for blog details
            
                        // Remove HTML tags and escape special characters
                        $plainDescription = htmlspecialchars(strip_tags($blog->description), ENT_XML1 | ENT_QUOTES, 'UTF-8');
                        $blogTitle = htmlspecialchars($blog->name, ENT_XML1 | ENT_QUOTES, 'UTF-8');
            
                        // Append blog item to RSS content
                        $rssContent .= <<<EOT
                <item>
                    <title>{$blogTitle}</title>
                    <link>{$blogUrl}</link>
                    <description><![CDATA[ {$plainDescription} ]]></description>
                    <pubDate>{$blog->created_at->format('D, d M Y H:i:s +0000')}</pubDate>
                </item>
            EOT;
                    }
            
                    // Close the RSS tags
                    $rssContent .= <<<EOT
                </channel>
            </rss>
            EOT;

        // Return the RSS content as the response
        return response($rssContent, 200, [
            'Content-Type' => 'application/rss+xml; charset=UTF-8',
        ]);
    }
}
