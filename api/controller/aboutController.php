<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



class AboutController extends BaseController
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
                $aboutModel = new About();

                $arrabout = $aboutModel->getAll()->fetch(PDO::FETCH_ASSOC);
                $responseData = json_encode($arrabout);
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
                $aboutModel = new  About();

                //save image to database and server
                $path = "";
                if ($_FILES["path"]) {
                    $filename = $_FILES["path"]["name"];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $tempName = $_FILES["path"]["tmp_name"];
                    $path   = uniqid(true) . "." . $ext;
                    move_uploaded_file($tempName, "D:\\Program File\\xampp\htdocs\\task26\image\\" . $path);
                }

                //get text values
                $input = $_POST;
                $input += ["path" => $path];

                $isCreated = $aboutModel->create($input);



                if ($isCreated) {
                    $responseData = json_encode(["message" => "about Created"]);
                } else {
                    $this->SetError(
                        'about NOT Created, try again!',
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
                $aboutModel = new  About();

                //get text values
                $input = $_POST;
                $input += ["path" => $input["path2"]];

                if (isset($_FILES["path"]) && $_FILES["path"]["error"] == UPLOAD_ERR_OK) {
                    $filename = $_FILES["path"]["name"];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $tempName = $_FILES["path"]["tmp_name"];
                    $path   = uniqid(true) . "." . $ext;
                    move_uploaded_file($tempName, "D:\\Program File\\xampp\htdocs\\task26\image\\" . $path);
                    $input["path"] = $path;
                }

                $isUpdate = $aboutModel->update($input);



                if ($isUpdate) {
                    $responseData = json_encode(["message" => "about Upadted"]);
                } else {
                    $responseData = json_encode(["message" => "about NOT Updated, try again!"]);
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
                $aboutModel = new  About();

                $arrabout = $aboutModel->getAll();
                if ($arrabout->rowCount() > 0) {
                    $aboutModel->delete();
                    $responseData = json_encode(["message" => "about deleted"]);
                } else {
                    $this->SetError("about not Found", "HTTP/1.1 404 not Found");
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
