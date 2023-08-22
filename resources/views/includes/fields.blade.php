@foreach ($fields as $fieldKey => $field)
    @if (is_numeric($fieldKey) && isset($field['fields']))
        <div class="lfb-fields-wrapper">
            @if (isset($field['group_info']))
                @if (isset($field['group_info']['title']) || isset($field['group_info']['description']) || isset($field['group_info']['description_view']))
                    <div>
                        @if (isset($field['group_info']['title']))
                            <h2 class="lfb-group-title">
                                {{ $field['group_info']['title'] }}
                            </h2>
                        @endif
                        @if (isset($field['group_info']['description']))
                            <p class="lfb-group-description">
                                {{ $field['group_info']['description'] }}
                            </p>
                        @endif
                        @if (isset($field['group_info']['description_view']))
                            @include($field['group_info']['description_view'])
                        @endif
                    </div>
                @endif
            @endif
            @php
                $customGroupWrapperClass = isset($field['group_info']['group_wrapper_class']) ? $field['group_info']['group_wrapper_class'] : null;
                $isGroupWrapperClassDefault = isset($field['group_info']['default_group_wrapper_class']) ? $field['group_info']['default_group_wrapper_class'] : true;
                if (!empty($customGroupWrapperClass)) {
                    $groupWrapperClass = !$isGroupWrapperClassDefault ? $customGroupWrapperClass : $groupWrapperClass . ' ' . $customGroupWrapperClass;
                }
            @endphp
                <div class="{{$groupWrapperClass}}">
                    @foreach ($field['fields'] as $groupFieldKey => $groupField)
                        @include('lara-forms-builder::form-components', [
                            'field' => $groupField,
                            'fieldKey' => $groupFieldKey,
                            'defaultFieldWrapperClass' => $defaultFieldWrapperClass
                        ])
                    @endforeach
                </div>
        </div>
    @else
        @include('lara-forms-builder::form-components', [
            'field' => $field,
            'fieldKey' => $fieldKey,
            'defaultFieldWrapperClass' => $defaultFieldWrapperClass
        ])
    @endif
@endforeach
