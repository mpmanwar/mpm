<section class="content-header">
    <div class="col-4">
        <h1>{{ $heading }}</h1>
    </div>
    <div class="col-4 logo_con">
        <a href="/practice-details">
            @if (file_exists('/practice_logo/{{ $practice_logo }}'))
                <img src="/practice_logo/{{ $practice_logo }}" class="browse_img" alt="" width="40">
            @endif
        </a>
    </div>
    
        <div class="home_right">
        <ol class="breadcrumb ">
            <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">{{ $title }}</li>
        </ol>
        </div>
 
    <div class="clearfix"></div>
</section>