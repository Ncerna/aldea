<?php
class ApiResponse {
  

    public static function successResult($affectedRows = 0, $data = [], $id = null) {
        $msg = $affectedRows > 0 ? 'operation successful.' : 'Registration is not complete.';
        return ['status' => $affectedRows > 0 , 'auth' => true, 'msg' => $msg, 'data' => $data, 'id' => $id];
    }
    
    public static function errorResult($msg, $auth = true) {
        return ['status' => false, 'auth' => $auth, 'msg' => $msg, 'data' => null];
    }
    public static function notFound($msg = 'Not found.') {
        return ['status' => false, 'auth' => true, 'msg' => $msg,'data' => null,'code' => 404 ];
    }
    public static function unauthorized($msg = 'Unauthorized.') {
        return ['status' => false, 'auth' => false, 'msg' => $msg, 'data' => null, 'code' => 401];
    }

    public static function forbidden($msg = 'Access denied.') {
        return ['status' => false, 'auth' => true, 'msg' => $msg, 'data' => null, 'code' => 403];
    }

    public static function validationError($errors = [], $msg = 'Validation failed.') {
        return ['status' => false, 'auth' => true, 'msg' => $msg, 'data' => $errors, 'code' => 422];
    }

    public static function serverError($msg = 'Internal Server Error.') {
        return ['status' => false, 'auth' => true, 'msg' => $msg, 'data' => null, 'code' => 500];
    }
}
?>