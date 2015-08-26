
                        <div class="notes_inner_top">
                        <img src="/img/icon_1.png" class="heading_icon" />
                        <div class="n_top_left">
                        <span class="n_heading">{{ $orgdtails_notes['title'] or "" }}</span>
                       
                       
                        <p><span class="n_heading_name">By {{$user['fname']}} {{$user['lname']}}</span> <span class="n_date">On: {{ $orgdtails_notes['created'] or "" }}</span></p>
                        </div>
                        <div class="print">
                        <a href="#"><img src="/img/print.png" /></a>
                       
                       
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        <p class="n_text">{{ $orgdtails_notes['textmessage'] or "" }}</p>
                        
                        <div class="add_client_btn">
                            <button class="btn btn-danger back" type="button">Delete</button>
                            <button class="btn btn-info" type="submit">Save</button>
                            <!-- <button class="btn btn-info open" data-id="7" type="button">Next</button> -->
                          </div>
                           <div class="clearfix"></div>
                