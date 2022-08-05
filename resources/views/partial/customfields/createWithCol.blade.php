@foreach ($fields as $field)
<?php $options = $field->field_options; ?>
<!-- check if dropdown -->
@if ($field->type == 'dropdown')

<div class="form-group">
    <label class="col-lg-4 control-label">{{ $field->label }} {{ $field->required ? '<abbr title="required">*</abbr>' : '' }}</label>
    <div class="col-lg-8">
        <select class="form-control" name="{{ 'custom['.$field->name.']' }}" {{ ($field->required) ? 'required' : '' }}>
            @foreach ($options['options'] as $opt)
            <option value="{{ $opt['label'] }}" {{ ($opt['checked']) ? 'selected="selected"' : '' }}>{{ $opt['label'] }}</option>
            @endforeach
        </select>
        <span class="help-block">{{ isset($options['description']) ? $options['description'] : '' }}</span>
    </div>

</div>

<!-- Text field -->
@elseif ($field->type == 'text')

<div class="form-group">
    <label class="col-lg-4 control-label">{{ $field->label }} {{ ($field->required) ? '<abbr title="required">*</abbr>' : '' }}</label>
    <div class="col-lg-8">
        <input type="text" name="{{ 'custom['.$field->name.']' }}" class="input-sm form-control" {{ ($field->required) ? 'required' : '' }}>
        <span class="help-block">{{ isset($options['description']) ? $options['description'] : '' }}</span>
    </div>
</div>

<!-- Textarea field -->
@elseif ($field->type == 'paragraph')

<div class="form-group">
    <label class="col-lg-4 control-label">{{ $field->label }} {{ ($field->required) ? '<abbr title="required">*</abbr>' : '' }}</label>
    <div class="col-lg-8">
        <textarea name="{{ 'custom['.$field->name.']' }}" class="form-control ta" {{ ($field->required) ? 'required' : '' }}></textarea>
        <span class="help-block">{{ isset($options['description']) ? $options['description'] : '' }}</span>
    </div>
</div>

<!-- Radio buttons -->
@elseif ($field->type == 'radio')
<div class="form-group">
    <label class="col-lg-4 control-label">{{ $field->label }} {{ ($field->required) ? '<abbr title="required">*</abbr>' : '' }}</label>
    <div class="col-lg-8">
        @foreach ($options['options'] as $opt)

        <div class="mt-2 text-gray-600 form-check">
            <label>

                <input type="radio" name="{{ 'custom['.$field->name.']' }}" {{ ($opt['checked']) ? 'checked="checked"' : '' }} value="{{ $opt['label'] }}"
                    {{ ($field->required) ? 'required' : '' }}>
                <span class="label-text">{{ $opt['label'] }}</span>

            </label>
        </div>

        @endforeach
        <span class="help-block">{{ isset($options['description']) ? $options['description'] : '' }}</span>
    </div>
</div>

<!-- Checkbox field -->
@elseif ($field->type == 'checkboxes')
<div class="form-group">
    <label class="col-lg-4 control-label">{{ $field->label }} {{ ($field->required) ? '<abbr title="required">*</abbr>' : '' }}</label>
    <div class="col-lg-8">

        @foreach ($options['options'] as $opt)
        <div class="checkbox">
            <label class="checkbox-custom">
                <input type="checkbox" name="{{ 'custom['.$field->name.']' }}[]" {{ ($opt['checked']) ? 'checked="checked"' : '' }} value="{{ $opt['label'] }}">
                <i class="fas fa-fw fa-square {{ ($opt['checked']) ? 'checked' : '' }}"></i>
                {{ $opt['label'] }}
            </label>
        </div>
        @endforeach
        <span class="help-block">{{ isset($options['description']) ? $options['description'] : '' }}</span>
    </div>

</div>
<!-- Email Field -->
@elseif ($field->type == 'email')

<div class="form-group">
    <label class="col-lg-4 control-label">{{ $field->label }} {{ ($field->required) ? '<abbr title="required">*</abbr>' : '' }}</label>
    <div class="col-lg-8">
        <input type="email" name="{{ 'custom['.$field->name.']' }}" class="input-sm form-control" {{ ($field->required) ? 'required' : '' }}>
        <span class="help-block">{{ isset($options['description']) ? $options['description'] : '' }}</span>
    </div>
</div>

@elseif ($field->type == 'section_break')
<hr />
@endif

@endforeach