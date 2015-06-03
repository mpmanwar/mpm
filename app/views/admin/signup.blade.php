<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>{{ $title }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

    </head>
    <body class="bg-black">
        
        <div class="form-box" id="login-box">

           <div class="header">
            @if(Session::has('message'))
              Thank you for signing up
            @else
              Sign Up
            @endif
            </div>

            <!--  <form action=" " method="post"> -->
            {{ Form::open(array('url' => '/signup-process', 'files' => true)) }}      
                <div class="body bg-gray">
                    @if ( $errors->count() > 0 )
                        <ul>
                            @foreach( $errors->all() as $message )
                              <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                
                <div style="color: red;font-size: 15px;">{{ Session::get('error_msg') }}</div>

                @if(Session::has('message'))
                <p>Activate your account</p>
                <p>An activation email has been sent to {{ Session::get('email') }}.</p>
                <p>Select the link in the email to verify the email address and activate your account.</p>
                <p>The link must be used within 24 hours or it will expire and you will need to register again.</p>
                
                @else
                
                
                <div class="firstname_con">
                    <div class="firstname">
                      <input type="text" name="fname" id="fname" class="form-control1" placeholder="First Name"/>
                    </div>
                    <div class="lastname">
                       <input type="text" name="lname" id="lname" class="form-control1" placeholder="Last Name"/>
                    </div>
                    <div class="clearfix"></div>
                </div>
                            
                    <!-- <div class="form-group">
                        <input type="text" name="practicename" id="practicename" class="form-control1" placeholder="Practice Name"/>
                    </div> -->
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control1" placeholder="Email Address"/>
                    </div>
                    
                    <div class="firstname_con">
                              <div class="firstname">
                                  <input type="password" name="password" id="password" class="form-control1" placeholder="Password"/>
                              </div>
                              <div class="lastname">
                                   <input type="password" name="confirmation_password" id="confirmation_password" class="form-control1" placeholder="Confirm Password"/>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                    
                    <div class="form-group">
                        <input type="text" name="phone" id="phone" class="form-control1" placeholder="Phone"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="website" id="website" class="form-control" placeholder="Website"/>
                    </div>
                    
                    <div class="form-group">
                    
                    <select class="form-control" id="country" name="country">
                        @if(!empty($coun))
                          @foreach($coun as $key=>$country_row)
                          @if(!empty($country_row->country_code) && $country_row->country_code == "GB")
                            <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
                          @endif
                          @endforeach
                        @endif
                        @if(!empty($coun))
                          @foreach($coun as $key=>$country_row)
                          @if(!empty($country_row->country_code) && $country_row->country_code != "GB")
                            <option value="{{ $country_row->country_id }}">{{ $country_row->country_name }}</option>
                          @endif
                          @endforeach
                        @endif
                    
                    </select>
                       
                    </div>

                   @endif 
                    
                </div>
                
            
                
                @if(!Session::has('message'))
                    <div class="footer">                    
                        <button type="submit" class="btn bg-olive btn-block">Get Started Now!</button>
                        <a href='/' class="text-center">I already have a membership</a>
                    </div>
                 @endif
            {{ Form::close() }}

            @if(!Session::has('message'))
                <div class="margin text-center">
                    <span>Register using social networks</span>
                    <br/>
                    <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                    <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                    <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
                </div>
                @endif
          

        </div>

    </body>
</html>