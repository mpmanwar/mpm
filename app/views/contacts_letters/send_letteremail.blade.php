@extends('layouts.layout')

@section('mycssfile')
    
@stop

@section('myjsfile')
<script src="{{ URL :: asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
  $(window).load(function() {
    
    CKEDITOR.replace( 'add_message',
    { 
        toolbar :[['Source'],['Cut','Copy','Paste','PasteText','SpellChecker'],['Undo','Redo','-','SelectAll','RemoveFormat'],[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ], ['SpecialChar','PageBreak']],
       
        extraPlugins : 'wordcount',
        wordcount : {
            showCharCount : true,
            showWordCount : true
            
            
        }
    });
    
    
   
});
</script>

@stop

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas {{ $left_class }}">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        @include('layouts.outer_leftside')
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side  {{ $right_class }}">
                <!-- Content Header (Page header) -->
                @include('layouts.below_header')

                <!-- Main content -->
                <section class="content">
      <div class="practice_mid"> 
        <form>
<div class="col-xs-12 email_maincon">
<div class="col-xs-8">
<div class="email_leftmain">
<div class="email_top">
<div class="email_top_left">
<div class="form-group">
<label for="exampleInputPassword1">Choose Template</label>
<select class="form-control">
<option>Anwar</option>
<option>R Sharma</option>
<option>Company</option>
</select>
</div>
</div>

<div class="email_top_right">
<a href="#"><img src="img/m_send.png" /></a>
<a href="#"><img src="img/download_latter.png" /></a>
</div>
<div class="clearfix"></div>
</div>

<div class="form-group">
<label for="exampleInputPassword1">Email Subject</label>
<input type="text" id="" class="form-control">
</div>
<textarea name="add_message" id="add_message" class="form-control" placeholder="Message" style="height: 250px;"></textarea>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="email_bottom_table">
  <tr>
    <td width="91%"><a href="#">Upload New</a></td>
    <td width="6%">Sign</td>
    <td width="3%"><input type="checkbox" /></td>
  </tr>
  <tr>
    <td><strong class="name_t">ABEL</strong><a href="#"><img src="img/cross_icon.png" /></a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</div>
</div>
<div class="col-xs-4">
<div class="input-group">
<input type="text" placeholder="Search" class="form-control input-sm">
<div class="input-group-btn">
<button class="btn btn-sm btn-primary" name="q" type="submit">ADD</button>
</div>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="email_search_list">
  <tr>
    <th>Client Name</th>
    <th>Contact Name</th>
    <th>Email</th>
    <th>&nbsp;</th>
  </tr>
  <tr>
    <td>R Sharma</td>
    <td>Mr. Rakesh</td>
    <td><a href="#">abel@cloud.com</a></td>
    <td><a href="#"><img src="img/cross_icon.png" /></a></td>
  </tr>
</table>


</div>

</div>
<div class="clearfix"></div>
        </form>
      </div>
    </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="upload_letterhead-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:300px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD NEW FILE</h4>
        <div class="clearfix"></div>
      </div>
    
    <input type="hidden" name="client_type" value="org" />
    <input type="hidden" name="back_url" value="add_org" />
      <div class="modal-body">
        

        <div class="form-group">
          <label for="exampleInputPassword1">Upload your customised .docx letterhead</label>
          <input type="file" class="form-control" name="upload_name" id="upload_name">
        </div>
        
        <div class="modal-footer1 clearfix">
          <div class="email_btns1">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-info" name="save">Save</button>
          </div>
        </div>
      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<!-- COMPOSE MESSAGE MODAL -->
<div class="modal fade" id="add_contact-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close save_btn" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD NEW FIELD</h4>
        <div class="clearfix"></div>
      </div>
    
      <div class="modal-body">
        

     <div class="form-group">
      <label for="exampleInputPassword1"><div style="float:left;">Contact Name</div> <div style="float:left; margin-left: 100px">File as <input type="checkbox"></div></label>
      <input type="text" id="res_addr_line1" name="res_addr_line1" class="form-control">
    </div>

    <div class="form-group">

    <div class="n_box01">
      <label for="exampleInputPassword1">Country Code</label>
      <input type="text" id="serv_tele_code" name="serv_tele_code" class="form-control" readonly>
    </div>

    <div class="telbox">
      <label for="exampleInputPassword1">Telephone</label>
      <input type="text" id="serv_telephone" name="serv_telephone" class="form-control"></div>
    <div class="clearfix"></div>
  </div>

  <div class="form-group">

    <div class="n_box01">
      <label for="exampleInputPassword1">Country Code</label>
      <input type="text" id="serv_mobile_code" name="serv_mobile_code" class="form-control" readonly>
    </div>
    <div class="telbox">
    <label for="exampleInputPassword1">Mobile</label>
        <input type="text" id="serv_mobile" name="serv_mobile" class="form-control"></div>
    <div class="clearfix"></div>
  </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Email</label>
      <input type="text" id="res_addr_line2" name="res_addr_line2" class="form-control">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Website</label>
      <input type="text" id="res_addr_line2" name="res_addr_line2" class="form-control">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1"><div style="float:left;">Company Name</div> <div style="float:left; margin-left: 100px">File as <input type="checkbox"></div></label>
      <input type="text" id="res_addr_line1" name="res_addr_line1"  class="form-control">
    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Select or Add</label> 

      <select class="form-control service_country" name="res_country" id="res_country">
      </select>                   
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Address Line 1</label>
      <input type="text" id="res_addr_line1" name="res_addr_line1" class="form-control">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Address Line 2</label>
      <input type="text" id="res_addr_line1" name="res_addr_line1" class="form-control">
    </div>

    <div class="twobox">
      <div class="twobox_1">
        <div class="form-group">
          <label for="exampleInputPassword1">City/Town</label>
          <input type="text" id="res_city" name="res_city" class="form-control">
        </div>
      </div>

      <div class="twobox_2">
        <div class="form-group">
          <label for="exampleInputPassword1">County</label>
          <input type="text" id="res_county" name="res_county" class="form-control">
        </div>
      </div>
      <div class="clearfix"></div>
    </div>

      <div class="twobox">
      <div class="twobox_1">
      <div class="form-group">
      <label for="exampleInputPassword1">Postcode</label>
      <input type="text" id="res_postcode" name="res_postcode" class="form-control">
      </div>
      </div>

      <div class="twobox_2">
      <div class="form-group">
      <label for="exampleInputPassword1">Country</label> 

        <select class="form-control service_country" name="res_country" id="res_country">
        </select>                   
      </div>
      </div>
      <div class="clearfix"></div>
      </div>


  
      <div class="modal-footer1 clearfix">
          <div class="add_client_btn">
      <button class="btn btn-info" type="button">Save</button>
      <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
    </div>
        </div>
      </div>
    
  </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@stop