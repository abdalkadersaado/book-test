<div class="wn__sidebar">
    <!-- Start Single Widget -->
    <aside class="widget search_widget">
        <h3 class="widget-title">Search</h3>
        {!! Form::open(['route' => 'frontend.search', 'method' => 'get']) !!}
        <div class="form-input">
            {!! Form::text('keyword', old('keyword', request()->keyword), ['placeholder' => 'Search...']) !!}
            {!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit']) !!}
        </div>
        {!! Form::close() !!}
    </aside>
    <!-- End Single Widget -->



    <!-- End Single Widget -->

    <!-- Start Single Widget -->
    <aside class="widget category_widget">
        <h3 class="widget-title">Genres</h3>
        <ul>
            @foreach($genres as $global_tag)
                <span style="background: #ebebeb none repeat  scroll 0 0; color: #333; display: inline-block; font-size: 12px; line-height: 20px; margin: 5px 5px 0 0; padding: 5px 15px; text-transform: capitalize;"><a href="">{{ $global_tag->title }} </a></span>
            @endforeach
        </ul>
    </aside>
    <!-- End Single Widget -->


</div>
