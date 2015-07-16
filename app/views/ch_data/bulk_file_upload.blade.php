@extends('layouts.layout')

@section('myjsfile')
<script src="{{ URL :: asset('js/ch_data.js') }}" type="text/javascript"></script>
@stop

@section('content')
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas {{ $left_class }}">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            @include('layouts.inner_leftside')
        </section>
        <!-- /.sidebar -->
    </aside>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side {{ $right_class }}">
    <!-- Content Header (Page header) -->
    @include('layouts.below_header')

    <!-- Main content -->
    <section class="content">
      <div class="practice_mid">
       <div class="bulk_header">BULK COMPANY UPLOAD</div>
          <div class="chdata_main">
            <div class="tab_topcon">
            {{ Form::open(array('url' => '/chdata/bulk-file-upload', 'files' => true)) }}
            <input type="hidden" name="back_url" value="{{ $back_url }}">
              <div class="import_search">
                <div class="import_search_box">
                  <input type="file" class="form-control" name="bulk_file" id="bulk_file">
                </div>
                <div class="import_search_btn">
                  <button type="submit" name="company_upload" class="btn btn-warning">Upload</button>
                </div>
                <div class="import_search_btn">
                  Max of 100 companies per upload
                </div>
                <div class="top_search_con">
                  <!-- <button type="button" class="btn btn-info import_client">IMPORT</button> -->
                </div>
                <div class="clearfix"></div>
              </div>
              {{ Form::close() }}

              <div class="clearfix"></div>
            </div>

            <!-- <h2>Results</h2> -->
            <!-- <div class="details_table">
              <div class="registered_table">
                <table width="100%" border="1" bordercolor="60aad2" style="text-align:center;" id="result">
                  <tr class="td_color">
                    <td colspan="3"><span class="sub_header">COMPANY NAME</span></td>
                  </tr>
                  
                </table>
              </div>
            </div> -->
          </div>

        <div class="bulk_text">File must be in either excel or CSV format with the company numbers laid out in a single column, with no column heading.</div>
      </div>
    </section>


</aside><!-- /.right-side -->
            

@stop



