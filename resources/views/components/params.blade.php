<form id="{{ $form_id or 'params_form' }}" action="/params" method="POST" style="overflow: auto">
    @foreach (App\SerialComparer::getAttributes() as $attr_en => $attr_ru)
    <div class="col-lg-4">
        <div class="form-group">
            <label for="" style="width: 100%">
                <!-- <input type="hidden" name="param_enabled[{{ $attr_en }}]" value="0"> -->
                <p class="param-title">{{ $attr_ru }} 
                    <input type="hidden" 
                    name="param_enabled[{{ $attr_en }}]" 
                    value=" 
                    @if (isset($post_enabled[$attr_en]) && $post_enabled[$attr_en] == 1)
                    1
                    @else 
                    0
                    @endif
                    "
                    >
                </p>
                <div class="slider-param">
                </div>
                @if (isset($post_data[$attr_en]))
                <input type="hidden" name="param[{{ $attr_en }}]" value="{{ $post_data[$attr_en] }}">
                @else
                <input type="hidden" name="param[{{ $attr_en }}]" value="50">
                @endif
            </label>
        </div>
    </div> 
    @endforeach
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>