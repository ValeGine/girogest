<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Exception;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GoogleCalendarController extends Controller
{
    public $client;

    public function __construct()
    {
        $this->client = $this->getClient();
    }


    public function getClient()
    {
        $client = new \Google_Client();
        $client->setApplicationName('Google Calendar API PHP Quickstart');
        $client->setRedirectUri('http://127.0.0.1:8000');
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $client->setAuthConfig('credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Load previously authorized token from a file, if it exists.
        // The file token.json stores the user's access and refresh tokens, and is
        // created automatically when the authorization flow completes for the first
        // time.
        $tokenPath = 'token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authUrl = $client->createAuthUrl();
                printf("Open the following link in your browser:\n%s\n", $authUrl);
                print 'Enter verification code: ';
                $authCode = trim(fgets(STDIN));

                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            // Save the token to a file.
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = new Google_Service_Calendar($this->client);

        // Print the next 10 events on the user's calendar.
        $calendarId = 'primary';
        $optParams = array(
            'maxResults' => 100,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => '0000-01-01T09:00:00-07:00',
        );
        $results = $service->events->listEvents($calendarId, $optParams);
        $events = $results->getItems();

        // dd($events);

        if (empty($events)) {
            return 'No events';
        } else {
            // $category_name = 'calendar';
            $data = [
            'category_name' => 'apps',
            'page_name' => 'calendar',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            ];
            return view('pages.apps.apps_calendar', compact('events'))->with($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $startDateTime = request('start');
        $endDateTime = request('end');

        $service = new Google_Service_Calendar($this->client);
        $calendarId = 'primary';

        $event = new Google_Service_Calendar_Event(array(
            'summary' => request('title'),
            'description' => request('description'),
            'start' => array(
              'dateTime' => $startDateTime,
              'timeZone' => 'America/Los_Angeles'
            ),
            'end' => array(
              'dateTime' => $endDateTime,
              'timeZone' => 'America/Los_Angeles'
            ),
            "colorId" => request('colorId')
          ));

        $event = $service->events->insert($calendarId, $event);
        if (!$event) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
        }
        return response()->json(['status' => 'success', 'message' => 'Event Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $format = 'Y-m-d\TH:i:sP';

        $start = new Google_Service_Calendar_EventDateTime();
        $startDate = new DateTime(request('start'), new DateTimeZone('America/Los_Angeles'));
        $startDate = $startDate->format($format);
        $start->setDateTime($startDate);
        // $start->setTimeZone('UTC');

        $end = new Google_Service_Calendar_EventDateTime();
        $endDate = new DateTime(request('end'), new DateTimeZone('America/Los_Angeles'));
        $endDate = $endDate->format($format);
        $end->setDateTime($endDate);

        // $end = new Google_Service_Calendar_EventDateTime;
        // $end->setDateTime(request('end'));

        // dd($dat);

        $service = new Google_Service_Calendar($this->client);
        $event = $service->events->get('primary', request('id'));

        $event->setSummary(request('title'));
        $event->setDescription(request('description'));
        $event->setStart($start);
        $event->setEnd($end);
        // $event->setEnd($end);
        $event->setColorId(request('className'));

        $updatedEvent = $service->events->update('primary', $event->getId(), $event);

        dd($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
