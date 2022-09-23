<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->bearerToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiZDY1YmMyNjY4ODcwODNlY2JlMjQ3NDIyODA2M2I1MTJlMGM0MGY0YjMxOWRkMTQyNmFmNmQ1YzBkMWMwY2M0MTYzZjExMWNhOGY4YjE5YzgiLCJpYXQiOjE2NjM5NDg5OTMuNDU2NDI3LCJuYmYiOjE2NjM5NDg5OTMuNDU2NDMsImV4cCI6MTY5NTQ4NDk5My4yODIzODQsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.U--6s8RUAP2JZJPdx-OntkKhQWIx3UlREaQMcGyB8R_hp5Jz38wwfK5P8A2qWQVE3T1k8bOB_IVYbGDYwYuVdXaNgYLlOhCmofO0K2JvcWA6jB-av-pRF3FBxffUn6qL4ShmxoNMBzbx66do9ERLC89qw3TwOCdFVLpA5F6UW9aCPtLBWFZCfHGjabphrctQOIiISjvowXm9GrxbcXvbTvyeX4PxSFmPNroz8lhFUySC_Tk2flEc-5tZ1as-iMcOA1yVdZOxfZm4qAB-hYWczQPomFt91pz8LLavk-d-nqzzycDfGJsPydzHgJU9qLU_hKNRDT4ylj2s9iM3W7gkem1aFXIn31WM-d5AgYZBKH-stf1GDWF9MWTwPpGpfxJN9SDwjQRrMKIIG7hG7-M2C6WvjVRLS4_1O-DTCLpMHKuNk90t7MS1QW4wuV1TFn_CKqiHECJgn3nnJmcN-ieOPmEfbmtprg9m6IlYtkne67pjZCfQiWUbSSWKUNxt9dCf2R_DMfpjzlfZTLPo01AREFx8SeHIm-hIDe2GIHlqn2jqffARW7uh22umg_6QQmbE17qOeu3m4iaRFhyfRijpiLY2Z1DiR9ImLZpMBkQVBSGOqor3j3EwiYqT6R6-J_dleOibcP5x9EbEPXM7dZzR3a4JkC78MpmSefpcP9A4Axc";
    }

    /**
     * @Given I have the payload:
     */
    public function iHaveThePayload(PyStringNode $string)
    {
        $this->payload = $string;
    }

    /**
     * @When /^I request "(GET|PUT|POST|DELETE|PATCH) ([^"]*)"$/
     */
    public function iRequest($httpMethod, $argument1)
    {
        $client = new GuzzleHttp\Client();
        $this->response = $client->request(
            $httpMethod,
            'http://127.0.0.1:8000' . $argument1,
            [
                'body' => $this->payload,
                'headers' => [
                    "Authorization" => "Bearer {$this->bearerToken}",
                    "Content-Type" => "application/json",
                ],
            ]
        );
        $this->responseBody = $this->response->getBody(true);
    }

    /**
     * @Then /^I get a response$/
     */
    public function iGetAResponse()
    {
        if (empty($this->responseBody)) {
            throw new Exception('Did not get a response from the API');
        }
    }

    /**
     * @Given /^the response is JSON$/
     */
    public function theResponseIsJson()
    {
        $data = json_decode($this->responseBody);

        if (empty($data)) {
            throw new Exception("Response was not JSON\n" . $this->responseBody);
        }
    }

    /**
     * @Then the response contains :arg1 records
     */
    public function theResponseContainsRecords($arg1)
    {
        $data = json_decode($this->responseBody);
        $count = count($data);

        return ($count == $arg1);
    }

    /**
     * @Then the question contains a title of :arg1
     */
    public function theQuestionContainsATitleOf($arg1)
    {
        $data = json_decode($this->responseBody);

        return $data->title == $arg1 ?: throw new Exception('The title does not match.');
    }
}
