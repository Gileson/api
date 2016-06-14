<?php
namespace Gileson\Api\Methods;

use Gileson\Api\AcrmRequest;
use Gileson\Api\Response\FailResponse;
use Gileson\Api\Response\ProductResponse;
use Gileson\Api\Response\ProductsResponse;
use Gileson\Api\Response\UploadResponse;

class Uploads extends AcrmRequest {

    const SECTION = 'uploads';
    

    /**
     * @return UploadResponse|FailResponse
     * @throws \Gileson\Api\AcrmApiException
     */
    function delete($id) {
        if(!$id) {
            return new FailResponse('Для удаления файла необходимо передать его ID');
        }
        $result = $this->send($this->getMethodUrl($id, 'delete'), [], 'POST');
        if($result instanceof FailResponse) {
            return $result;
        }

        return new UploadResponse($result);
    }

}