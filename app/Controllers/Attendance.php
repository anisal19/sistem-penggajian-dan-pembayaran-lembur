<?php
namespace App\Controllers;
class Attendance extends BaseController {
    public function index() {
        return view('attendances/index');
    }
}