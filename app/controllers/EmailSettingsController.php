<?php

//use Excel;
class EmailSettingsController extends BaseController {
		
	public function index()
	{
		$data['title'] 				= "Email Settings";
		$data['template_types'] 	= TemplateType::orderBy("template_type_name", "ASC")->get();
		$data['email_templates'] 	= EmailTemplate::orderBy("email_template_id", "DESC")->get();

		$data['email_templates'] 	= DB::table('email_templates')
		    ->join('template_types', 'email_templates.template_type_id', '=', 'template_types.template_type_id')
		    ->select('email_templates.*', 'template_types.template_type_name')->get();
		//echo $this->last_query();die;
        //echo "<pre>";print_r($data);die;
		return View::make("email_settings.index", $data);
	}

	public function show_edit_template()
	{
		$template_id = Input::get("template_id");
		if(Request::ajax())
    	{
			//$data['template_types'] 	= TemplateType::orderBy("template_type_name", "ASC")->get();
			$data['emailTemplates'] 	= EmailTemplate::where("email_template_id", $template_id)->first();

	        //echo "<pre>";print_r($data['emailTemplates']);die;
			//echo View::make("email_settings.edit_template", $data);
			echo json_encode($data['emailTemplates']);
		}
	}

	public function get_template()
	{
		$template_id = Input::get("template_id");
		if(Request::ajax())
    	{
			$template 		= Template::where("template_type_id", $template_id)->first();
			//echo $this->last_query();die;
			if(!empty($template) && count($template) >0){
				echo json_encode($template);
			}else{
				echo json_encode("fail");
			}
			
		}
	}

	public function add_email_template()
	{
		$tmpl_data = array();
		$postData = Input::all();

		$tmpl_data['name']				= $postData['add_name'];
		$tmpl_data['template_type_id']	= $postData['add_template_type'];
		$tmpl_data['title']				= $postData['add_title'];
		$tmpl_data['message']			= $postData['add_message'];
		$tmpl_data['created']			= date("Y-m-d H:i:s");
		$pd_id = EmailTemplate::insert($tmpl_data);
		if ($pd_id) {
			Session::flash('success', 'New email template has been added.');
		}else{
			Session::flash('error', 'There are some error to add new email template.');
		}
		
		return Redirect::to('/email-settings');
		
	}

	public function edit_email_template()
	{
		$tmpl_data = array();
		$postData = Input::all();

		$tmpl_data['name']				= $postData['edit_name'];
		$tmpl_data['template_type_id']	= $postData['edit_template_type'];
		$tmpl_data['title']				= $postData['edit_title'];
		$tmpl_data['message']			= $postData['edit_message'];
		$tmpl_data['modified']			= date("Y-m-d H:i:s");
		$update = EmailTemplate::where("email_template_id", "=", $postData['edit_email_template_id'])->update($tmpl_data);
		//echo $this->last_query();die;
		if ($update) {
			Session::flash('success', 'Email template successfully updated.');
		}else{
			Session::flash('error', 'There are some error to update email template.');
		}
		
		return Redirect::to('/email-settings');
		
	}

	public function delete_email_template()
	{
		$tmpl_data = array();
		$eml_tmpl_id = Input::get('eml_tmpl_id');
		if(Request::ajax())
    	{
			$del = EmailTemplate::where("email_template_id", "=", $eml_tmpl_id)->delete();
			if ($del) {
				$msg = "success";
				Session::flash('success', 'Email template has been deleted successfully.');
			}else{
				$msg = "fail";
				Session::flash('error', 'There are some error to delete this email template.');
			}
			echo $msg;
			exit;
		}
		
	}


}
