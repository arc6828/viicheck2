<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mylog;

class DealersController extends Controller
{
    public function index(Request $request)
    {
    	//รับค่า
		$lats = $_GET['lat'];
		$lngs = $_GET['lng'];

		if(!empty($lats) or !empty($lngs)){

			$dealer = DB::select("SELECT name_dealers,location,province,( 3959 * acos( cos( radians($lats) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lngs) ) + sin( radians($lats) ) * sin( radians( latitude ) ) ) ) AS distance FROM dealers  HAVING distance < 2000 ORDER BY distance LIMIT 0 , 5", []);

        	return response()->json($dealer);

		    echo "<pre>";
		    print_r($dealer);
		    echo "</pre>";

		}

	}

	public function store(Request $request)
	{
		$access_token = 'zdNI46IvAlLQF7ekb658ryh8u7AGNTOOV59XXcG1ValPZ14iutLa6f+lezyaNXGUNA9SPWTBr4ooOYPusYcwuZjsy6khvF717wmNnAEBu4oEr79QZthPiU4GYS1rsAoMUI6+qtFljOlxGgM4qdezaQdB04t89/1O/w1cDnyilFU=';
		// Get POST body content
		// $content = file_get_contents('php://input');

		$content = $request->all();
        $data = [
            "title" => "Line",
            "content" => json_encode($content, JSON_UNESCAPED_UNICODE),
        ];
        Mylog::create($data);

		// Parse JSON
		$events = $content;
		// Validate parsed JSON data
		if (!is_null($events['events'])) {
		    // Loop through each event
		    foreach ($events['events'] as $event) {
		        // Reply only when message sent is in 'text' format
		        if ($event['type'] == 'message' && $event['message']['type'] == 'location') {
		            // Get text sent
		            $lat = $event['message']['latitude'];
		            $lng = $event['message']['longitude'];
		            $Your_location = $lat . " / " . $lng ;

		            $dealer = DB::select("SELECT name_dealers,location,province,( 3959 * acos( cos( radians($lats) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lngs) ) + sin( radians($lats) ) * sin( radians( latitude ) ) ) ) AS distance FROM dealers  HAVING distance < 2000 ORDER BY distance LIMIT 0 , 5", []);

        				return response()->json($dealer);

		            // Get replyToken
		            $replyToken = $event['replyToken'];
		            // Build message to reply back
		            $messages = [
		                'type' => 'text',
		                'text' => $Your_location,
		            ];
		            // Make a POST Request to Messaging API to reply to sender
		            $url = 'https://api.line.me/v2/bot/message/reply';
		            $data = [
		                'replyToken' => $replyToken,
		                'messages' => [$messages]
		            ];
		            $post = json_encode($data);
		            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
		            $ch = curl_init($url);
		            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		            $result = curl_exec($ch);
		            curl_close($ch);
		            echo $result . "";
		        }
		    }
		}

	}

}
