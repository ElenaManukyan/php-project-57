<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Следующие строки содержат стандартные сообщения об ошибках валидации.
    | Некоторые правила имеют несколько вариантов (например size).
    | При необходимости их можно легко изменить.
    |
    */

    'accepted'             => 'Поле :attribute должно быть принято.',
    'accepted_if'          => 'Поле :attribute должно быть принято, когда :other равно :value.',
    'active_url'           => 'Поле :attribute содержит недопустимый URL.',
    'after'                => 'Поле :attribute должно содержать дату после :date.',
    'after_or_equal'       => 'Поле :attribute должно содержать дату после или равную :date.',
    'alpha'                => 'Поле :attribute может содержать только буквы.',
    'alpha_dash'           => 'Поле :attribute может содержать только буквы, цифры, дефисы и подчёркивания.',
    'alpha_num'            => 'Поле :attribute может содержать только буквы и цифры.',
    'array'                => 'Поле :attribute должно быть массивом.',
    'ascii'                => 'Поле :attribute должно содержать только однобайтовые буквенно-цифровые символы и символы.',
    'before'               => 'Поле :attribute должно содержать дату до :date.',
    'before_or_equal'      => 'Поле :attribute должно содержать дату до или равную :date.',
    'between'              => [
        'numeric' => 'Поле :attribute должно быть от :min до :max.',
        'file'    => 'Размер файла в поле :attribute должен быть от :min до :max килобайт.',
        'string'  => 'Количество символов в поле :attribute должно быть от :min до :max.',
        'array'   => 'Количество элементов в поле :attribute должно быть от :min до :max.',
    ],
    'boolean'              => 'Поле :attribute должно быть true или false.',
    'confirmed'            => 'Пароль и подтверждение не совпадают.',
    'current_password'     => 'Неверный пароль.',
    'date'                 => 'Поле :attribute не является корректной датой.',
    'date_equals'          => 'Поле :attribute должно быть датой равной :date.',
    'date_format'          => 'Поле :attribute не соответствует формату :format.',
    'decimal'              => 'Поле :attribute должно содержать :decimal знаков после запятой.',
    'declined'             => 'Поле :attribute должно быть отклонено.',
    'declined_if'          => 'Поле :attribute должно быть отклонено, когда :other равно :value.',
    'different'            => 'Поля :attribute и :other должны отличаться.',
    'digits'               => 'Поле :attribute должно содержать :digits цифр.',
    'digits_between'       => 'Поле :attribute должно содержать от :min до :max цифр.',
    'dimensions'           => 'Поле :attribute имеет недопустимые размеры изображения.',
    'distinct'             => 'Поле :attribute содержит повторяющееся значение.',
    'doesnt_end_with'      => 'Поле :attribute не должно заканчиваться одним из следующих: :values.',
    'doesnt_start_with'    => 'Поле :attribute не должно начинаться с одного из следующих: :values.',
    'email'                => 'Поле :attribute должно быть корректным email-адресом.',
    'ends_with'            => 'Поле :attribute должно заканчиваться одним из следующих: :values.',
    'enum'                 => 'Выбранное значение для :attribute некорректно.',
    'exists'               => 'Выбранное значение для :attribute некорректно.',
    'file'                 => 'Поле :attribute должно быть файлом.',
    'filled'               => 'Поле :attribute обязательно для заполнения.',
    'gt'                   => [
        'numeric' => 'Поле :attribute должно быть больше :value.',
        'file'    => 'Размер файла в поле :attribute должен быть больше :value килобайт.',
        'string'  => 'Количество символов в поле :attribute должно быть больше :value.',
        'array'   => 'Поле :attribute должно содержать больше :value элементов.',
    ],
    'gte'                  => [
        'numeric' => 'Поле :attribute должно быть больше или равно :value.',
        'file'    => 'Размер файла в поле :attribute должен быть больше или равен :value килобайт.',
        'string'  => 'Количество символов в поле :attribute должно быть больше или равно :value.',
        'array'   => 'Поле :attribute должно содержать :value или больше элементов.',
    ],
    'image'                => 'Поле :attribute должно быть изображением.',
    'in'                   => 'Выбранное значение для :attribute некорректно.',
    'in_array'             => 'Поле :attribute не существует в :other.',
    'integer'              => 'Поле :attribute должно быть целым числом.',
    'ip'                   => 'Поле :attribute должно быть корректным IP-адресом.',
    'ipv4'                 => 'Поле :attribute должно быть корректным IPv4-адресом.',
    'ipv6'                 => 'Поле :attribute должно быть корректным IPv6-адресом.',
    'json'                 => 'Поле :attribute должно быть корректной JSON-строкой.',
    'lowercase'            => 'Поле :attribute должно быть в нижнем регистре.',
    'lt'                   => [
        'numeric' => 'Поле :attribute должно быть меньше :value.',
        'file'    => 'Размер файла в поле :attribute должен быть меньше :value килобайт.',
        'string'  => 'Количество символов в поле :attribute должно быть меньше :value.',
        'array'   => 'Поле :attribute должно содержать меньше :value элементов.',
    ],
    'lte'                  => [
        'numeric' => 'Поле :attribute должно быть меньше или равно :value.',
        'file'    => 'Размер файла в поле :attribute должен быть меньше или равен :value килобайт.',
        'string'  => 'Количество символов в поле :attribute должно быть меньше или равно :value.',
        'array'   => 'Поле :attribute не должно содержать больше :value элементов.',
    ],
    'mac_address'          => 'Поле :attribute должно быть корректным MAC-адресом.',
    'max'                  => [
        'numeric' => 'Поле :attribute не может быть больше :max.',
        'file'    => 'Размер файла в поле :attribute не может быть больше :max килобайт.',
        'string'  => 'Количество символов в поле :attribute не может превышать :max.',
        'array'   => 'Поле :attribute не может содержать больше :max элементов.',
    ],
    'max_digits'           => 'Поле :attribute не должно содержать больше :max цифр.',
    'mimes'                => 'Поле :attribute должно быть файлом одного из следующих типов: :values.',
    'mimetypes'            => 'Поле :attribute должно быть файлом одного из следующих типов: :values.',
    'min'                  => [
        'numeric' => 'Поле :attribute должно быть не меньше :min.',
        'file'    => 'Размер файла в поле :attribute должен быть не менее :min килобайт.',
        'string'  => 'Пароль должен иметь длину не менее 8 символов',
        'array'   => 'Поле :attribute должно содержать как минимум :min элементов.',
    ],
    'min_digits'           => 'Поле :attribute должно содержать не менее :min цифр.',
    'missing'              => 'Поле :attribute должно отсутствовать.',
    'missing_if'           => 'Поле :attribute должно отсутствовать когда :other равно :value.',
    'missing_unless'       => 'Поле :attribute должно отсутствовать, если :other не равно :value.',
    'missing_with'         => 'Поле :attribute должно отсутствовать когда присутствует :values.',
    'missing_with_all'     => 'Поле :attribute должно отсутствовать когда присутствуют :values.',
    'multiple_of'          => 'Поле :attribute должно быть кратно :value.',
    'not_in'               => 'Выбранное значение для :attribute некорректно.',
    'not_regex'            => 'Формат поля :attribute некорректен.',
    'numeric'              => 'Поле :attribute должно быть числом.',
    'present'              => 'Поле :attribute должно присутствовать.',
    'prohibited'           => 'Поле :attribute запрещено.',
    'prohibited_if'        => 'Поле :attribute запрещено когда :other равно :value.',
    'prohibited_unless'    => 'Поле :attribute запрещено, если :other не входит в :values.',
    'prohibits'            => 'Поле :attribute запрещает присутствие :other.',
    'regex'                => 'Формат поля :attribute некорректен.',
    'required'             => 'Это обязательное поле.',
    'required_array_keys'  => 'Поле :attribute должно содержать значения для: :values.',
    'required_if'          => 'Поле :attribute обязательно для заполнения, когда :other равно :value.',
    'required_if_accepted' => 'Поле :attribute обязательно, когда :other принято.',
    'required_unless'      => 'Поле :attribute обязательно, когда :other не равно :values.',
    'required_with'        => 'Поле :attribute обязательно, когда :values присутствует.',
    'required_with_all'    => 'Поле :attribute обязательно, когда :values присутствуют.',
    'required_without'     => 'Поле :attribute обязательно, когда :values отсутствует.',
    'required_without_all' => 'Поле :attribute обязательно, когда ни одно из :values не присутствует.',
    'same'                 => 'Значения полей :attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => 'Поле :attribute должно быть равным :size.',
        'file'    => 'Размер файла в поле :attribute должен быть равен :size килобайт.',
        'string'  => 'Количество символов в поле :attribute должно быть равно :size.',
        'array'   => 'Поле :attribute должно содержать :size элементов.',
    ],
    'starts_with'          => 'Поле :attribute должно начинаться с одного из следующих: :values',
    'string'               => 'Поле :attribute должно быть строкой.',
    'timezone'             => 'Поле :attribute должно быть корректным часовым поясом.',
    'unique'               => 'Статус с таким именем уже существует.',
    'uploaded'             => 'Загрузка файла :attribute не удалась.',
    'uppercase'            => 'Поле :attribute должно быть в верхнем регистре.',
    'url'                  => 'Формат поля :attribute некорректен.',
    'ulid'                 => 'Поле :attribute должно быть корректным ULID.',
    'uuid'                 => 'Поле :attribute должно быть корректным UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'своё-сообщение',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */

    'attributes' => [],
];
