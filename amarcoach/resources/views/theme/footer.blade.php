<footer id="footer" class="footer-main-block">
    <div class="container-fluid">
        <div class="footer-block">
            <div class="row">
                @php
                    $widgets = App\WidgetSetting::first();
                @endphp
                <div class="col-lg-3 col-md-6">
                    @php
                        $settings = App\Setting::first();
                    @endphp
                    <div class="footer-logo">
                        @if($settings->logo_type == 'L')
                            @if($settings->footer_logo != NULL)
                            <a href="{{ url('/') }}" title="logo"><img src="{{ asset('images/logo/'.$settings->footer_logo) }}" alt="logo" class="img-fluid" ></a>
                            @endif
                        @else()
                            <a href="{{ url('/') }}"><b>{{ $settings->project_title }}</b></a>
                        @endif
                    </div>
                    <div class="footer-text text-white">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vitae turpis ac ipsum vestibulum posuere. 
                    Donec magna lorem, molestie ut commodo non, luctus vel est. Suspendisse potenti.
                    </div>

                    <div class="mobile-btn">
                        @if($settings->play_download == '1')
                            <a href="{{ $settings->play_link }}" title=""><img src="{{ url('images/icons/download-google-play.png') }}" alt="logo"></a>
                        @endif
                        @if($settings->app_download == '1')
                            <a href="{{ $settings->app_link }}" title=""><img src="{{ url('images/icons/app-download-ios.png') }}" alt="logo"></a>
                        @endif
                    </div>

                </div>
                @if(isset($widgets))

                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_one }}</b></div>
                    <div class="footer-link">
                        <ul>
                            @if($gsetting->instructor_enable == 1)
                                @if(Auth::check())
                                    @if(Auth::User()->role == "user")
                                    <li><a href="#" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a></li>
                                    @endif
                                @else
                                    <li><a href="{{ route('login') }}" title="Become an instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a></li>
                                @endif
                            @endif
                             @php $category= \app\Categories::where('status',1)->take(6)->get();  @endphp   
                            @foreach($category as $cat)
                                <li><a href="{{ route('category.page',['id' => $cat->id, 'category' => str_slug(str_replace('-','&',$cat->title))]) }}">{{ $cat->title }}</a></li>
                               
                            @endforeach

                            
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_two }}</b></div>
                    <div class="footer-link">
                        <ul>
                            <li><a href="{{ route('about.show') }}" title="About Us">{{ __('frontstaticword.Aboutus') }}</a></li>
                            <li><a href="{{ route('careers.show') }}" title="Careers">{{ __('frontstaticword.Careers') }}</a></li>
                            <li><a href="{{url('user_contact')}}" title="Contact Us">{{ __('frontstaticword.Contactus') }}</a></li>
                            <li><a href="{{ route('help.show') }}" title="Help">{{ __('frontstaticword.Help&Support') }}</a></li>
                            <li><a href="{{url('terms_condition')}}" title="Terms">{{ __('frontstaticword.Terms&Condition') }}</a></li> 
                            <li><a href="{{url('privacy_policy')}}" title="Policy">{{ __('frontstaticword.PrivacyPolicy') }}</a></li>
                            <li><a href="{{ route('blog.all') }}" title="Blog">{{ __('frontstaticword.Blog') }}</a></li> 
                            @php
                                $pages = App\Page::get();
                            @endphp
                            
                            @if(isset($pages))
                            @foreach($pages as $page)
                                @if($page->status == 1)
                                <li><a href="{{ route('page.show', $page->slug) }}" title="{{ $page->title }}">{{ $page->title }}</a></li>
                                @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget"><b>{{ $widgets->widget_three }}</b></div>
                    @php
                       
                            $blogss = App\Blog::take(5)->get();
                       
                    @endphp
                    @if( ! $blogss->isEmpty() )
                    <div class="footer-link">
                
                        @foreach($blogss as $blog)
                            <div class="view-blog">
                                <b><a href="{{ route('blog.detail', $blog->id) }}">{{ str_limit($blog['heading'], $limit = 30, $end = '...') }}</a></b>
                                <!-- <p class="btm-10"><a herf="#">{{ __('frontstaticword.by') }} {{ $blog->user['fname'] }} {{ $blog->user['lname'] }}</a></p> -->
                                <p class="btm-10"><a herf="#" style="color:#ddd">Created At: {{ date('d-m-Y | h:i:s A',strtotime($blog['created_at'])) }}</a></p>
                            </div>
                        @endforeach        
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    <hr>
    <div class="tiny-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="logo-footer">
                        <ul>
                            <li>{{ $cpy_txt }}</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="language-btn">
                        @php
                            $languages = App\Language::all(); 
                        @endphp
                        @if(isset($languages) && count($languages) > 0)
                        <div class="footer-dropdown">
                            <a href="#" class="a" data-toggle="dropdown"><i class="fa fa-globe rgt-15"></i>{{Session::has('changed_language') ? ucfirst(Session::get('changed_language')) : ''}}<i class="fa fa-angle-up lft-10"></i></a>
                            
                            <ul class="dropdown-menu">
                                @foreach($languages as $language)
                                <a href="{{ route('languageSwitch', $language->local) }}"><li>{{$language->name}}</li></a>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="copyright-social">
                        <ul>
                            <li></li>
                        </ul>
                    </div>
                </div>

            </div><!--row-->
        </div>
    </div>
</footer>

@include('instructormodel')
