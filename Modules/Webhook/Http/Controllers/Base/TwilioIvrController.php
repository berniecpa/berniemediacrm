<?php

namespace Modules\Webhook\Http\Controllers\Base;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Twilio\Twiml;

/**
 * This is a sample class on how to implement IVR using Twilio
 */
abstract class TwilioIvrController extends Controller
{
    public function __construct()
    {
        $this->_thankYouMessage = 'Thank you for calling the ET Phone Home' .
            ' Service - the adventurous alien\'s first choice' .
            ' in intergalactic travel.';
    }
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function showWelcome()
    {
        $response = new Twiml();
        $gather = $response->gather(
            [
                'numDigits' => 1,
                'action' => route('ivr.menu.response', get_option('cron_key'), false),
            ]
        );

        $gather->say(
            'Thanks for calling the E T Phone Home Service.' .
            'Please press 1 for directions. Press 2 for a ' .
            'list of planets to call.',
            ['loop' => 3]
        );

        return $response;
    }
    /**
     * Responds to selection of an option by the caller
     *
     * @return \Illuminate\Http\Response
     */
    public function showMenuResponse(Request $request)
    {
        $selectedOption = $request->input('Digits');

        switch ($selectedOption) {
            case 1:
                return $this->getReturnInstructions();
            case 2:
                return $this->getPlanetsMenu();
        }

        $response = new Twiml();
        $response->say(
            'Returning to the main menu',
            ['voice' => 'Alice', 'language' => 'en-GB']
        );
        $response->redirect(route('ivr.incoming', get_option('cron_key'), false));

        return $response;
    }

    /**
     * Responds with a <Dial> to the caller's planet
     *
     * @return \Illuminate\Http\Response
     */
    public function showPlanetConnection(Request $request)
    {
        $response = new Twiml();
        $response->say(
            $this->_thankYouMessage,
            ['voice' => 'Alice', 'language' => 'en-GB']
        );
        $response->say(
            "You'll be connected shortly to your planet",
            ['voice' => 'Alice', 'language' => 'en-GB']
        );
        $planetNumbers = [
            '2' => '+12024173378',
            '3' => '+12027336386',
            '4' => '+12027336637',
        ];
        $selectedOption = $request->input('Digits');
        $planetNumberExists = isset($planetNumbers[$selectedOption]);
        if ($planetNumberExists) {
            $selectedNumber = $planetNumbers[$selectedOption];
            $response->dial($selectedNumber);
            return $response;
        } else {
            $errorResponse = new Twiml();
            $errorResponse->say(
                'Returning to the main menu',
                ['voice' => 'Alice', 'language' => 'en-GB']
            );
            $errorResponse->redirect(route('ivr.incoming', get_option('cron_key'), false));
            return $errorResponse;
        }
    }
    /**
     * Responds with instructions to mothership
     * @return Services_Twilio_Twiml
     */
    private function getReturnInstructions()
    {
        $response = new Twiml();
        $response->say(
            'To get to your extraction point, get on your bike and go down the' .
            ' street. Then Left down an alley. Avoid the police cars. Turn left' .
            ' into an unfinished housing development. Fly over the roadblock. Go' .
            ' passed the moon. Soon after you will see your mother ship.',
            ['voice' => 'Alice', 'language' => 'en-GB']
        );
        $response->say(
            $this->_thankYouMessage,
            ['voice' => 'Alice', 'language' => 'en-GB']
        );
        $response->hangup();
        return $response;
    }
    /**
     * Responds with instructions to choose a planet
     * @return Services_Twilio_Twiml
     */
    private function getPlanetsMenu()
    {
        $response = new Twiml();
        $gather = $response->gather(
            ['numDigits' => '1', 'action' => route('ivr.planet.connection', get_option('cron_key'), false)]
        );
        $gather->say(
            'To call the planet Brodo Asogi, press 2. To call the planet' .
            ' Dugobah, press 3. To call an Oober asteroid to your location,' .
            ' press 4. To go back to the main menu, press the star key',
            ['voice' => 'Alice', 'language' => 'en-GB']
        );
        return $response;
    }
}
