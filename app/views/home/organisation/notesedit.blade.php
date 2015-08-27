
@if(!empty($inserted_id))
 {{$inserted_id or ""}}|||
 @endif

                        <div class="notes_inner_top">
                        <img src="/img/icon_1.png" class="heading_icon">
                        <div class="n_top_left">
                        <span class="n_heading">{{ $orgdtails_notes['title'] or "" }}</span>
                       
                       
                         <p><span class="n_heading_name">By {{$user['fname']}} {{$user['lname']}}</span> <span class="n_date">On: {{ $orgdtails_notes['created'] or "" }}</span></p>
                        </div>
                        <div class="print">
                        <a href="#"><img src="/img/print.png"></a>
                       
                       
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        <p class="n_text">{{ $orgdtails_notes['textmessage'] or "" }} </p>
                        
                        <div class="add_client_btn">
                             
                          </div>
                           <div class="clearfix"></div>
                 