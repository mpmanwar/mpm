<?php
//opcache_reset ();
//Cache::forget('user_list');

class NoticeboardController extends BaseController
{

    public function notice_board()
    {
        //die('NoticeboardController');
        $data['heading'] = "NOTICE BOARD";
        $data['title'] = "Notice Board";
        $admin_s = Session::get('admin_details');
        $user_id = $admin_s['id'];
        //print_r($user_id);die();
        $groupUserId = $admin_s['group_users'];

        //echo '<pre>';print_r($groupUserId);die();


        $data['attach'] = DB::table('users')->whereIn("users.user_id", $groupUserId)->
            join('noticefonts', 'users.user_id', '=', 'noticefonts.user_id')->select('users.user_id',
            'users.fname', 'users.lname', 'noticefonts.file', 'noticefonts.noticefont_id')->
            get();

        //echo $this->last_query();die();


        $data['user'] = User::whereIn("user_id", $groupUserId)->select("fname", "lname",
            "user_id")->get();


        $arr = array();
        foreach ($data['user'] as $key => $val) {

            $arr[$key]['user_id'] = $data['user'][$key]->user_id;
            $arr[$key]['fname'] = $this->getInitials($data['user'][$key]->fname);
            $arr[$key]['lname'] = $data['user'][$key]->lname;


        }

        $data['username'] = $arr;

        // echo "<pre>";print_r($data['username']);die();

        $data['font'] = Noticefont::whereIn("user_id", $groupUserId)->where("board_no",
            "=", "1")->select("noticefont_id", "user_id", "board_no",
            "message", "message_subject", "checkbox", "file", "created")->orderBy('noticefont_id',
            'DESC')->take(6)->get();

        $data['font2'] = Noticefont::whereIn("user_id", $groupUserId)->where("board_no",
            "=", "2")->select("noticefont_id", "user_id",  "board_no",
            "message", "message_subject", "checkbox", "file", "created")->orderBy('noticefont_id',
            'DESC')->take(6)->get();

        //echo $this->last_query();die();
        //echo $data['font'];die();
        //("DATE_FORMAT(time,'%d/%m/%Y %h:%i %p') AS time", FALSE);

        $data['userfullname'] = User::where("user_id", $user_id)->select("fname",
            "lname")->first();

            
            
            $data['excel'] = Noticeexcel::whereIn("user_id", $groupUserId)->select("file")->get();
            
            //echo '<pre>';print_r($data['excel']);die();
            


        $arr = array();
        foreach ($data['excel'] as $key => $val) {

            $arr[$key]['file'] = $data['excel'][$key]->file;
           //print_r($arr[$key]['file']);die();
            }
            
            
            //echo "<pre>";print_r($data['excel']);die();

            
        //echo $this->last_query();


        //$data['che'] = Noticefont::whereIn("checkbox", $groupUserId)->whereIn("user_id", $user_id)->select("noticefont_id")->first();

        //echo "<pre>";print_r($data['che']);die();

        return View::make('notice.noticeboard', $data);

    }

    public function getInitials($name)
    {
        $init = '';
        $name = explode(' ', $name);
        foreach ($name as $part)
            $init .= strtoupper(substr($part, 0, 1));
        return $init;
    }


    public function index_template()
    {

        //die('gjkgkgk');

        $data['heading'] = "NOTICE BOARD";
        $data['title'] = "Notice Board";
        //$data['practice_logo'] = "Notice BOARD";
        //$data['practice_name'] = "Notice BOARD";
        $session = Session::get('admin_details');
        $groupUserId = $session['group_users'];
        //$data['admin_name'] = "Notice BOARD";
        $data['user_id'] = $session['id'];


        $data['user'] = User::select("fname", "lname")->get();
        $arr = array();
        foreach ($data['user'] as $key => $val) {

            $arr[$key]['fname'] = $this->getInitials($data['user'][$key]->fname);
            $arr[$key]['lname'] = $this->getInitials($data['user'][$key]->lname);

        }

        $data['username'] = $arr;


        return View::make('notice.noticeboard', $data);
        //echo '<pre>';
        //print_r($data['user'][0]->fname);
        //die();


    }


    public function insert_noticeboard()
    {


        $postData = Input::all();
        //echo "<pre>";
        // print_r($postData);
        //die();
        $arrData = array();

        $admin_s = Session::get('admin_details');
        $user_id = $admin_s['id'];


        //################  #################//
        $step_id = 1;
        if (!empty($postData['ni_number'])) {
            $arrData[] = $this->save_notice($user_id, $step_id, 'ni_number', $postData['ni_number']);
        }

        echo "<pre>";
        print_r($arrData);
        die();
    }


    public function save_notice($user_id, $step_id, $field_name, $field_value)
    {
        $data = array();
        $data['user_id'] = $user_id;
        $data['step_id'] = $step_id;
        $data['field_name'] = $field_name;
        $data['field_value'] = $field_value;
        return $data;

    }


    public function notice_template()
    {

        $tmpl_data = array();

        $session = Session::get('admin_details');
        $groupUserId = $session['group_users'];

        $session = Session::get('admin_details');
        $tmpl_data['user_id'] = $session['id'];
        $postData = Input::all();

        $messages = array("message_subject.required" => "Please enter  message subject", );

        $rules = array("message_subject" => "required", );

        $validator = Validator::make($postData, $rules, $messages);

        if ($validator->fails()) {

            return Redirect::to('/noticeboard')->withErrors($validator)->withInput();
        } else {

            //echo "<pre>";print_r($postData);die();

            // if (isset($postData['notifycheck']) && !empty($postData['notifycheck'])) {
            // $arr = $postData['notifycheck'];
            // $arrnotify = implode(",", $arr);

            // }


            //if (isset($postData['typecatagory']) && !empty($postData['typecatagory'])) {

            //   $tmpl_data['typecatagory'] = $postData['typecatagory'];

            // }

            $tmpl_data['board_no'] = $postData['board_no'];
            if (isset($postData['add_message']) && !empty($postData['add_message'])) {
                $tmpl_data['message'] = $postData['add_message'];
            }
            if (isset($postData['message_subject']) && !empty($postData['message_subject'])) {
                $tmpl_data['message_subject'] = $postData['message_subject'];
            }

            if (isset($postData['notifycheckadd']) && !empty($postData['notifycheckadd'])) {

                //$notice_email = User::whereIn("user_id", $postData['notifycheckadd'])->select("email")->get();

                //$tmpl_data['email']=$notice_email;

                $arr = $postData['notifycheckadd'];

                //echo '<pre>'; print_r($postData['notifycheckadd']);


                //echo $this->last_query();die();


                $arrnotify = serialize($arr);
                //print_r($arrnotify);die();
                //$arrnotify = implode(",", $arr);
                $tmpl_data['checkbox'] = $arrnotify;
            }


            $tmpl_data['created'] = date("Y-m-d H:i:s");


            //echo '<pre>'; print_r($tmpl_data);die();
            $noticefont_id = Noticefont::insertGetId($tmpl_data);


            if (isset($postData['notifycheckadd']) && !empty($postData['notifycheckadd'])) {

                $data['user_email'] = User::whereIn("user_id", $postData['notifycheckadd'])->
                    select("email")->get();
                //echo $this->last_query();die();
                // $tmpl_data['email']=$notice_email;

                $arr = array();

                foreach ($data['user_email'] as $key => $val) {
                    $arr[$key] = $data['user_email'][$key]->email;
                    $tmpl_data['emailnotice'] = $arr[$key];
                    $this->send_notice($tmpl_data);
                }

                //$tmpl_notice = $arr;
                //echo '<pre>'; print_r($tmpl_notice);die();

                //$arr_notice = implode(",", $arr);
                //$tmpl_data['email']=$arr_notice;
                //echo '<pre>'; print_r($tmpl_data['email']);
                //die();

            }


            if ($noticefont_id) {
                //////////////////file upload start//////////////////
                if (Input::hasFile('add_file')) {
                    $file = Input::file('add_file');
                    $destinationPath = "uploads/noticeTemplates/";
                    $fileName = Input::file('add_file')->getClientOriginalName();

                    $fileName = $noticefont_id . $fileName;
                    $result = Input::file('add_file')->move($destinationPath, $fileName);

                    $file_data['file'] = $fileName;
                    Noticefont::where("noticefont_id", "=", $noticefont_id)->update($file_data);

                }
                /////////////////file upload end////////////////////

            }


            // $chk = Noticefont::where("noticefont_id", "=",$noticefont_id)->select("checkbox")->first();
            // $data['check']=$chk->checkbox;

            //  $myArray = explode(',', $data['check']);
            //print_r($myArray);

            /*   $data['che'] = User::whereIn("user_id", $groupUserId)->select("user_id")->get();
            
            $arrchk = array();
            foreach ($data['che'] as $key => $val) {

            $arrchk[$key]['user_id'] = $data['che'][$key]->user_id;
            }
            
            $data['checkdata'] = $arrchk;   */

            //echo '<pre>';print_r($data['checkdata']);
            //echo '<pre>';print_r($myArray);

            // die();

            //$this->send_notice($tmpl_data);

            return Redirect::to('/noticeboard');
            //echo "<pre>";print_r($pd_id);
            //die();


            // $file = Input::file('add_file');
            // $destinationPath = "uploads/noticeTemplates/";

        }
    }


    private function send_notice($data)
    {


        Mail::send('emails.notice', $data, function ($message)use ($data)
        {
            $message->from('abel02@icloud.com', 'MPM Notice'); $message->to($data['emailnotice'])->
                subject("Welcome to MPM Notice Board");
                //$message->to('subhajit.poddar@appsbee.com')->subject("Welcome to MPM Noticeboard");

        }
        );
    }


    public function edit_template($id)
    {


        $data['temp_details'] = Noticefont::where("noticefont_id", $id)->select("noticefont_id",
            "user_id", "typecatagory", "message", "message_subject", "checkbox", "file",
            "created")->get();


        print_r($id);
        die();


    }


    public function delete_template($id)
    {

        $affected = Noticefont::where('noticefont_id', '=', $id)->delete();
        return Redirect::to('/noticeboard');

    }


    public function delete_attachment($id)
    {
        //print_r($id);die();
        $fileatt = Noticefont::where("noticefont_id", "=", $id)->select('file')->first();

        $file = $fileatt->file;
        $del = Noticefont::where("noticefont_id", "=", $id)->update(array('file' => ''));

        unlink('uploads/noticeTemplates/' . $file);

        //$affected = Noticefont::where('noticefont_id', '=', $id)->delete();
        return Redirect::to('/noticeboard');

    }


    public function show_edit_noticetemplate()
    {
        //die('fsfsfss');
        $noticefont_id = Input::get("noticefont_id");

        $admin_s = Session::get('admin_details');
        $user_id = $admin_s['id'];
        //print_r($user_id);die();
        $groupUserId = $admin_s['group_users'];

        //echo $groupUserId;


        //echo $noticefont_id; die();
        if (Request::ajax()) {

            $noticeTemplates = Noticefont::where("noticefont_id", $noticefont_id)->first();
            $noticeTemplates['group'] = $groupUserId;


            header('Content-Type: application/json; charset=utf-8');

            echo json_encode($noticeTemplates);
            exit;
        }
    }


    public function edit_notice_template()
    {
        //die('sfwfwf');
        $tmpl_data = array();
        echo "<pre>";
        $postData = Input::all();
        $session = Session::get('admin_details');
        $groupUserId = $session['group_users'];

        // print_r($postData['edit_notice_template_id']);
        // die();
        // print_r($postData);
        // die('hkhkhk');


        //print_r($arr);die();


        $chk = Noticefont::where("noticefont_id", "=", $postData['edit_notice_template_id'])->
            select("checkbox")->first();
        $data['check'] = $chk->checkbox;

        $mychkArray = explode(',', $data['check']);


        $tmpl_data['user_id'] = $session['id'];


        // $tmpl_data['typecatagory'] = $postData['typecatagory'][0];
        
        if (isset($postData['edit_message']) && !empty($postData['edit_message'])) {
                
                 $tmpl_data['message'] = $postData['edit_message'];                
            }
        
        
       

        $tmpl_data['message_subject'] = $postData['message_subject'];

        //print_r($postData['chknotify']);die();

        if (isset($postData['notifychecked']) && !empty($postData['notifychecked'])) {
            $arr = $postData['notifychecked'];
            //$arrnotifyed = implode(",", $arr);

            //print_r($postData['notifychecked']);

            $arrnotifyed = serialize($arr);

            $tmpl_data['checkbox'] = $arrnotifyed;
            //print_r($arrnotifyed);die();
            // $tmpl_data['checkbox'] = rtrim($arrnotifyed,',');
        } else {

            $tmpl_data['checkbox'] = "";

        }


        $tmpl_data['created'] = date("Y-m-d H:i:s");
        //print_r($tmpl_data);die();
        $update = Noticefont::where("noticefont_id", "=", $postData['edit_notice_template_id'])->
            update($tmpl_data);


        if (isset($postData['notifychecked']) && !empty($postData['notifychecked'])) {

            $data['user_email'] = User::whereIn("user_id", $postData['notifychecked'])->
                select("email")->get();
            //echo $this->last_query();die();
            // $tmpl_data['email']=$notice_email;

            $arr = array();

            foreach ($data['user_email'] as $key => $val) {
                $arr[$key] = $data['user_email'][$key]->email;
                $tmpl_data['emailnotice'] = $arr[$key];
                $this->send_notice($tmpl_data);
            }


        }


        //echo $this->last_query();die;
        if ($update) {
            //////////////////file upload start//////////////////
            if (Input::hasFile('edit_attach_file')) {
                $file = Input::file('edit_attach_file');
                $destinationPath = "uploads/noticeTemplates/";
                $fileName = Input::file('edit_attach_file')->getClientOriginalName();
                $fileName = $postData['edit_notice_template_id'] . $fileName;
                $result = Input::file('edit_attach_file')->move($destinationPath, $fileName);

                $file_data['file'] = $fileName;
                Noticefont::where("noticefont_id", "=", $postData['edit_notice_template_id'])->
                    update($file_data);

                ### delete the previous image if exists ###
                $prevPath = "uploads/noticeTemplates/" . $postData['hidd_file'];
                if ($postData['hidd_file'] != "") {
                    if (file_exists($prevPath)) {
                        unlink($prevPath);
                    }
                }
                ### delete the previous image if exists ###

            }
            /////////////////file upload end////////////////////

        }

        $chk = Noticefont::where("noticefont_id", "=", $postData['edit_notice_template_id'])->
            select("checkbox")->first();


        //SELECT * FROM `users` WHERE user_id IN (SELECT checkbox FROM `noticefonts` WHERE noticefont_id = '44')
        Cache::flush();
        //die('die');
        return Redirect::to('/noticeboard');

    }


    public function excel_upload()
    {
        //die('fsfsf');
        $postData = Input::all();
        $arrData = array();
        $file_data = array();
        //echo "<pre>";
        //print_r($postData);
        //die();

        $admin_s = Session::get('admin_details');
        $user_id = $admin_s['id'];
        $group_id = $admin_s['group_id'];
        $groupUserId = $admin_s['group_users'];


        $path = 'uploads/' . $group_id;

        if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $path = 'uploads/' . $group_id . '/noticeExcel/';
        if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }


        if (Input::hasFile('add_file1')) {

                    $file = Input::file('add_file1');
                    $destinationPath = 'uploads/' . $group_id . '/noticeExcel/';
                    $fileName = Input::file('add_file1')->getClientOriginalName();
                    //$fileName = $noticefont_id . $fileName;
                    $result = Input::file('add_file1')->move($destinationPath, $fileName);
        
        
                    $file_data['user_id'] = $user_id;
                    $file_data['group_id'] = $group_id;
                    $file_data['file'] = $fileName;
                    $file_data['level'] = 1;
        
                    //Noticeexcel::insert($file_data);
        
        
                   $chkfile = Noticeexcel::where("group_id", $group_id)->where("level", "=",
                        "1")->select("noticeexcel_id","file")->first();
        
                    
                    
                    //die();
        
                    if (isset($chkfile) && count($chkfile) >0) {
                        
                        
                        $noticeexcel_id = $chkfile['noticeexcel_id'];
                        
                        $file_name=$chkfile['file'];
                        //print_r($file_name);die();
                        
                       //$prevPath = './uploads/' . $group_id . '/noticeExcel/'. $file_name;
                        //die();
                       // if (file_exists("uploads/".$group_id.'/noticeExcel/'.$file_name.'')) {
                        //        unlink('uploads/' . $group_id . '/noticeExcel/'. $file_name.'');
                        //    }
                        
                        
                        
                        Noticeexcel::where("noticeexcel_id", "=", $noticeexcel_id)->update($file_data);
        
                    } else {
                        Noticeexcel::insert($file_data);
                    }

            // $arrData[] = $this->excel_notice($user_id,$file_level, $file_data['file1']);
        }
        
        //die('file1');

        if (Input::hasFile('add_file2')) {
            $file = Input::file('add_file2');
            $destinationPath = 'uploads/' . $group_id . '/noticeExcel/';
            $fileName = Input::file('add_file2')->getClientOriginalName();

            //$fileName = $noticefont_id . $fileName;
            $result = Input::file('add_file2')->move($destinationPath, $fileName);

            $file_data['user_id'] = $user_id;
            $file_data['group_id'] = $group_id;
            $file_data['file'] = $fileName;
            $file_data['level'] = 2;


            $chkfile = Noticeexcel::where("group_id", $group_id)->where("level", "=",
                "2")->select("noticeexcel_id")->first();

            if (isset($chkfile) && count($chkfile) >0) {
                $noticeexcel_id = $chkfile['noticeexcel_id'];
                $file_name=$chkfile['file'];
                //$prevPath = './uploads/' . $group_id . '/noticeExcel/'. $file_name;
                
                //if (file_exists('uploads/' . $group_id . '/noticeExcel/'. $file_name)) {
                //        unlink('uploads/' . $group_id . '/noticeExcel/'. $file_name);
                //    }
                
                Noticeexcel::where("noticeexcel_id", "=", $noticeexcel_id)->update($file_data);

            } else {
                Noticeexcel::insert($file_data);
            }

        }

        if (Input::hasFile('add_file3')) {
            $file = Input::file('add_file3');
            $destinationPath = 'uploads/' . $group_id . '/noticeExcel/';
            $fileName = Input::file('add_file3')->getClientOriginalName();

            //$fileName = $noticefont_id . $fileName;
            $result = Input::file('add_file3')->move($destinationPath, $fileName);

            $file_data['user_id'] = $user_id;
            $file_data['group_id'] = $group_id;
            $file_data['file'] = $fileName;
            $file_data['level'] = 3;

            $chkfile = Noticeexcel::where("user_id", $group_id)->where("level", "=",
                "3")->select("noticeexcel_id")->first();

            

           if (isset($chkfile) && count($chkfile) >0) {
                $noticeexcel_id = $chkfile['noticeexcel_id'];
                $file_name=$chkfile['file'];
               // $prevPath = './uploads/' . $group_id . '/noticeExcel/'. $file_name;
                
              //  if (file_exists('uploads/' . $group_id . '/noticeExcel/'. $file_name)) {
               //         unlink('uploads/' . $group_id . '/noticeExcel/'. $file_name);
                //    }
                Noticeexcel::where("noticeexcel_id", "=", $noticeexcel_id)->update($file_data);

            } else {
                Noticeexcel::insert($file_data);
            }

        }
        
        if (Input::hasFile('add_file4')) {
            $file = Input::file('add_file4');
            $destinationPath = 'uploads/' . $group_id . '/noticeExcel/';
            $fileName = Input::file('add_file4')->getClientOriginalName();

            //$fileName = $noticefont_id . $fileName;
            $result = Input::file('add_file4')->move($destinationPath, $fileName);

            $file_data['user_id'] = $user_id;
            $file_data['group_id'] = $group_id;
            $file_data['file'] = $fileName;
            $file_data['level'] = 4;

            $chkfile = Noticeexcel::where("group_id", $group_id)->where("level", "=",
                "4")->select("noticeexcel_id")->first();

            
            if (isset($chkfile) && count($chkfile) >0) {
                $noticeexcel_id = $chkfile['noticeexcel_id'];
                $file_name=$chkfile['file'];
               // $prevPath = './uploads/' . $group_id . '/noticeExcel/'. $file_name;
               
               //if (file_exists('uploads/' . $group_id . '/noticeExcel/'. $file_name)) {
                   //     unlink('uploads/' . $group_id . '/noticeExcel/'. $file_name);
                  //  }
                Noticeexcel::where("noticeexcel_id", "=", $noticeexcel_id)->update($file_data);

            } else {
                Noticeexcel::insert($file_data);
            }

            //$arrData[] = $this->excel_notice($user_id,$file_level, $file_data['file4']);

        }
        
        if (Input::hasFile('add_file5')) {
            $file = Input::file('add_file5');
            $destinationPath = 'uploads/' . $group_id . '/noticeExcel/';
            $fileName = Input::file('add_file5')->getClientOriginalName();

            //$fileName = $noticefont_id . $fileName;
            $result = Input::file('add_file5')->move($destinationPath, $fileName);

             $file_data['user_id'] = $user_id;
            $file_data['group_id'] = $group_id;
            $file_data['file'] = $fileName;
            $file_data['level'] = 5;

            $chkfile = Noticeexcel::where("group_id", $group_id)->where("level", "=",
                "5")->select("noticeexcel_id")->first();

           if (isset($chkfile) && count($chkfile) >0) {
                $noticeexcel_id = $chkfile['noticeexcel_id'];
                $file_name=$chkfile['file'];
                
                
                //$prevPath = './uploads/' . $group_id . '/noticeExcel/'. $file_name;
                
                //if (file_exists('uploads/' . $group_id . '/noticeExcel/'. $file_name)) {
                //        unlink('uploads/' . $group_id . '/noticeExcel/'. $file_name);
                //    }
                    
                Noticeexcel::where("noticeexcel_id", "=", $noticeexcel_id)->update($file_data);
                
                //$prevPath = './uploads/' . $user_id . '/noticeExcel/';
                
                //if ($postData['hidd_file'] != "") {
                  //  if (file_exists($prevPath)) {
                   //     unlink($prevPath);
                  //  }
                //}

            } else {
                Noticeexcel::insert($file_data);
            }

            //$arrData[] = $this->excel_notice($user_id,$file_level,$file_data['file5']);


        }
        /////////////////file upload end////////////////////


        //return Redirect::to('/noticeboard');
        

    }


    /*  public function excel_notice($user_id,$file_level,$file) {
    $data = array();
    $data['user_id'] = $user_id;
    $data['level'] = $file_level;
    $data['file'] = $file;
    return $data;
    
    }
    */
}
