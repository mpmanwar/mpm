<?php
class ContactController extends BaseController {
    
    public function index()
    {      
        $data['page_title'] = "Contact";
        return View::make('contact.contact', $data);
       
    }
}
