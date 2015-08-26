<section class="content-header">
    <div class="col-4">
        <h1>{{ $heading }}</h1>
    </div>
    <div class="col-4 logo_con">{{ $practice_logo }}
        <!-- <a href="/practice-details" id="image_preview">
            {{ $practice_logo }}
        </a> -->
    </div>
    
        <div class="home_right">
        <ol class="breadcrumb ">
            <li><a href="{{ $dashboard_url }}"><i class="fa fa-home"></i> Dashboard</a></li>
            @if(isset($previous_page))
            <li>{{ $previous_page }}</li>
            @endif
            @if(isset($sub_url))
            <li>{{ $sub_url }}</li>
            @endif

            @if(isset($title) && $title != "Dashboard")
            {{ '<li class="active">'.$title.'</li>' }}
            @endif
            
        </ol>
        </div>
 
    <div class="clearfix"></div>
</section>