<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



class CategoryController extends BaseController
{
    private $RequestMethod = "GET";
    private $ErrorDesc = "";
    private $ErrorHeader = "";

    public function Index($limit = 100)
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($this->RequestMethod) == 'GET') {

            try {
                $categoryModel = new Category();

                if (
                    isset($arrQueryStringParams['limit'])
                    && $arrQueryStringParams['limit']
                ) {
                    $limit = (int)$arrQueryStringParams['limit'];
                }

                $arrcategory = $categoryModel->getAll($limit)->fetchAll(PDO::FETCH_ASSOC);
                $responseData = json_encode($arrcategory);
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

    public function Details($id)
    {

        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'GET') {
            try {
                $categoryModel = new  Category();

                $arrcategory = $categoryModel->getBy($id);
                if ($arrcategory->rowCount() > 0) {
                    $responseData = json_encode($arrcategory->fetch(PDO::FETCH_ASSOC));
                } else {
                    $this->SetError("category not Found", "HTTP/1.1 404 not Found");
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
    public function Create()
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'POST') {
            try {
                $categoryModel = new  Category();
                $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                $isCreated = $categoryModel->create($input);

                if ($isCreated) {
                    $responseData = json_encode(["message" => "category Created"]);
                } else {
                    $this->SetError(
                        'category NOT Created, try again!',
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
    public function Update($id)
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];


        if (strtoupper($this->RequestMethod) == 'POST') {
            try {
                $categoryModel = new  Category();
                $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                $isUpdate = $categoryModel->update($input, $id);

                if ($isUpdate) {
                    $responseData = json_encode(["message" => "category Upadted"]);
                } else {
                    $responseData = json_encode(["message" => "category NOT Updated, try again!"]);
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

    public function Delete($id)
    {
        $this->RequestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($this->RequestMethod) == 'POST') {

            try {
                $categoryModel = new  Category();

                $arrcategory = $categoryModel->getBy($id);
                if ($arrcategory->rowCount() > 0) {
                    $categoryModel->delete($id);
                    $responseData = json_encode(["message" => "category deleted"]);
                } else {
                    $this->SetError("category not Found", "HTTP/1.1 404 not Found");
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
