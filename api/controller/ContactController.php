<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



class ContactController extends BaseController
{
    private $RequestMethod = "GET";
    private $ErrorDesc = "";
    private $ErrorHeader = "";

    public function Index()
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($this->RequestMethod) == 'GET') {

            try {
                $contactModel = new Contact();

                $arrcontact = $contactModel->getAll()->fetch(PDO::FETCH_ASSOC);
                $responseData = json_encode($arrcontact);
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong!please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }


        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }

    public function Create()
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'POST') {
            try {
                $contactModel = new  Contact();
                $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                $isCreated = $contactModel->create($input);

                if ($isCreated) {
                    $responseData = json_encode(["message" => "contact Created"]);
                } else {
                    $this->SetError(
                        'contact NOT Created, try again!',
                        'HTTP/1.1 400 Bad Request'
                    );
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong!please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }
    public function Update()
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'POST') {
            try {
                $contactModel = new  Contact();
                $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                $isUpdate = $contactModel->update($input);

                if ($isUpdate) {
                    $responseData = json_encode(["message" => "contact Upadted"]);
                } else {
                    $responseData = json_encode(["message" => "contact NOT Updated, try again!"]);
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong!please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorDesc)
            );
        }
    }

    public function Delete()
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($this->RequestMethod) == 'POST') {

            try {
                $contactModel = new  Contact();

                $arrcontact = $contactModel->getAll();
                if ($arrcontact->rowCount() > 0) {
                    $contactModel->delete();
                    $responseData = json_encode(["message" => "contact deleted"]);
                } else {
                    $this->SetError("contact not Found", "HTTP/1.1 404 not Found");
                }
            } catch (Error $e) {
                $this->SetError(
                    $e->getMessage() . 'Something went wrong!please contact support.',
                    'HTTP/1.1 500 Internal Server Error'
                );
            }
        } else {
            $this->SetError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
        }

        // send output
        if (!$this->ErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $this->ErrorDesc)),
                array('Content-Type: application/json', $this->ErrorHeader)
            );
        }
    }




    private function SetError($errorDesc, $errorheader)
    {
        $this->ErrorDesc = $errorDesc;
        $this->ErrorHeader = $errorheader;
    }
}
