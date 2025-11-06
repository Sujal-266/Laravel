<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute ફીલ્ડ સ્વીકારવું આવશ્યક છે.',
    'accepted_if' => ':other :value હોય ત્યારે :attribute ફીલ્ડ સ્વીકારવું આવશ્યક છે.',
    'active_url' => ':attribute ફીલ્ડ માન્ય URL હોવું જોઈએ.',
    'after' => ':attribute ફીલ્ડ :date પછીની તારીખ હોવી જોઈએ.',
    'after_or_equal' => ':attribute ફીલ્ડ :date પછી અથવા બરાબર તારીખ હોવી જોઈએ.',
    'alpha' => ':attribute ફીલ્ડમાં ફક્ત અક્ષરો જ હોવા જોઈએ.',
    'alpha_dash' => ':attribute ફીલ્ડમાં ફક્ત અક્ષરો, અંક, ડેશ અને અન્ડરસ્કોર જ હોવા જોઈએ.',
    'alpha_num' => ':attribute ફીલ્ડમાં ફક્ત અક્ષરો અને અંક જ હોવા જોઈએ.',
    'array' => ':attribute ફીલ્ડ એ એરે હોવું જોઈએ.',
    'ascii' => ':attribute ફીલ્ડમાં ફક્ત ASCII અક્ષરો અને ચિહ્નો જ હોવા જોઈએ.',
    'before' => ':attribute ફીલ્ડ :date પહેલાંની તારીખ હોવી જોઈએ.',
    'before_or_equal' => ':attribute ફીલ્ડ :date પહેલાં અથવા બરાબર તારીખ હોવી જોઈએ.',
    'between' => [
        'array' => ':attribute ફીલ્ડમાં :min થી :max વસ્તુઓ હોવી જોઈએ.',
        'file' => ':attribute ફીલ્ડ :min થી :max કિલોબાઇટ વચ્ચે હોવું જોઈએ.',
        'numeric' => ':attribute ફીલ્ડ :min થી :max વચ્ચે હોવું જોઈએ.',
        'string' => ':attribute ફીલ્ડ :min થી :max અક્ષરો વચ્ચે હોવું જોઈએ.',
    ],
    'boolean' => ':attribute ફીલ્ડ સાચું અથવા ખોટું હોવું જોઈએ.',
    'can' => ':attribute ફીલ્ડમાં માન્ય મૂલ્ય નથી.',
    'confirmed' => ':attribute ફીલ્ડ પુષ્ટિ મેળ ખાતી નથી.',
    'current_password' => 'પાસવર્ડ ખોટો છે.',
    'date' => ':attribute ફીલ્ડ માન્ય તારીખ હોવી જોઈએ.',
    'date_equals' => ':attribute ફીલ્ડ :date બરાબર તારીખ હોવી જોઈએ.',
    'date_format' => ':attribute ફીલ્ડ ફોર્મેટ :format સાથે મેળ ખાતું હોવું જોઈએ.',
    'decimal' => ':attribute ફીલ્ડમાં :decimal દશાંશ હોવા જોઈએ.',
    'declined' => ':attribute ફીલ્ડ નકારવું આવશ્યક છે.',
    'declined_if' => ':other :value હોય ત્યારે :attribute ફીલ્ડ નકારવું આવશ્યક છે.',
    'different' => ':attribute અને :other અલગ હોવા જોઈએ.',
    'digits' => ':attribute ફીલ્ડ :digits અંકોનું હોવું જોઈએ.',
    'digits_between' => ':attribute ફીલ્ડ :min થી :max અંકો વચ્ચે હોવું જોઈએ.',
    'dimensions' => ':attribute ફીલ્ડમાં અમાન્ય છબી પરિમાણો છે.',
    'distinct' => ':attribute ફીલ્ડમાં નકલી મૂલ્ય છે.',
    'doesnt_end_with' => ':attribute ફીલ્ડ નીચેના પૈકી કોઈ પણ સાથે સમાપ્ત થવું જોઈએ નહીં: :values.',
    'doesnt_start_with' => ':attribute ફીલ્ડ નીચેના પૈકી કોઈ પણ સાથે શરૂ થવું જોઈએ નહીં: :values.',
    'email' => ':attribute ફીલ્ડ માન્ય ઇમેઇલ હોવું જોઈએ.',
    'ends_with' => ':attribute ફીલ્ડ નીચેના પૈકી એક સાથે સમાપ્ત થવું જોઈએ: :values.',
    'enum' => 'પસંદ કરેલ :attribute અમાન્ય છે.',
    'exists' => 'પસંદ કરેલ :attribute અમાન્ય છે.',
    'extensions' => ':attribute ફીલ્ડમાં નીચેના એક્સટેન્શન હોવું જોઈએ: :values.',
    'file' => ':attribute ફીલ્ડ ફાઇલ હોવું જોઈએ.',
    'filled' => ':attribute ફીલ્ડમાં મૂલ્ય હોવું જોઈએ.',
    'gt' => [
        'array' => ':attribute ફીલ્ડમાં :value કરતાં વધુ વસ્તુઓ હોવી જોઈએ.',
        'file' => ':attribute ફીલ્ડ :value કિલોબાઇટ કરતાં વધુ હોવું જોઈએ.',
        'numeric' => ':attribute ફીલ્ડ :value કરતાં વધુ હોવું જોઈએ.',
        'string' => ':attribute ફીલ્ડ :value અક્ષરો કરતાં વધુ હોવું જોઈએ.',
    ],
    'gte' => [
        'array' => ':attribute ફીલ્ડમાં :value વસ્તુઓ અથવા વધુ હોવી જોઈએ.',
        'file' => ':attribute ફીલ્ડ :value કિલોબાઇટ કરતાં વધુ અથવા બરાબર હોવું જોઈએ.',
        'numeric' => ':attribute ફીલ્ડ :value કરતાં વધુ અથવા બરાબર હોવું જોઈએ.',
        'string' => ':attribute ફીલ્ડ :value અક્ષરો કરતાં વધુ અથવા બરાબર હોવું જોઈએ.',
    ],
    'hex_color' => ':attribute ફીલ્ડ માન્ય હેક્સ કલર હોવું જોઈએ.',
    'image' => ':attribute ફીલ્ડ છબી હોવું જોઈએ.',
    'in' => 'પસંદ કરેલ :attribute અમાન્ય છે.',
    'in_array' => ':attribute ફીલ્ડ :other માં હોવું જોઈએ.',
    'integer' => ':attribute ફીલ્ડ પૂર્ણાંક હોવું જોઈએ.',
    'ip' => ':attribute ફીલ્ડ માન્ય IP સરનામું હોવું જોઈએ.',
    'ipv4' => ':attribute ફીલ્ડ માન્ય IPv4 સરનામું હોવું જોઈએ.',
    'ipv6' => ':attribute ફીલ્ડ માન્ય IPv6 સરનામું હોવું જોઈએ.',
    'json' => ':attribute ફીલ્ડ માન્ય JSON સ્ટ્રિંગ હોવું જોઈએ.',
    'list' => ':attribute ફીલ્ડ યાદી હોવું જોઈએ.',
    'lowercase' => ':attribute ફીલ્ડ નાના અક્ષરોમાં હોવું જોઈએ.',
    'lt' => [
        'array' => ':attribute ફીલ્ડમાં :value કરતાં ઓછી વસ્તુઓ હોવી જોઈએ.',
        'file' => ':attribute ફીલ્ડ :value કિલોબાઇટ કરતાં ઓછી હોવું જોઈએ.',
        'numeric' => ':attribute ફીલ્ડ :value કરતાં ઓછી હોવું જોઈએ.',
        'string' => ':attribute ફીલ્ડ :value અક્ષરો કરતાં ઓછી હોવું જોઈએ.',
    ],
    'lte' => [
        'array' => ':attribute ફીલ્ડમાં :value કરતાં વધુ વસ્તુઓ હોવી જોઈએ નહીં.',
        'file' => ':attribute ફીલ્ડ :value કિલોબાઇટ કરતાં ઓછી અથવા બરાબર હોવું જોઈએ.',
        'numeric' => ':attribute ફીલ્ડ :value કરતાં ઓછી અથવા બરાબર હોવું જોઈએ.',
        'string' => ':attribute ફીલ્ડ :value અક્ષરો કરતાં ઓછી અથવા બરાબર હોવું જોઈએ.',
    ],
    'mac_address' => ':attribute ફીલ્ડ માન્ય MAC સરનામું હોવું જોઈએ.',
    'max' => [
        'array' => ':attribute ફીલ્ડમાં :max કરતાં વધુ વસ્તુઓ હોવી જોઈએ નહીં.',
        'file' => ':attribute ફીલ્ડ :max કિલોબાઇટ કરતાં વધુ હોવું જોઈએ નહીં.',
        'numeric' => ':attribute ફીલ્ડ :max કરતાં વધુ હોવું જોઈએ નહીં.',
        'string' => ':attribute ફીલ્ડ :max અક્ષરો કરતાં વધુ હોવું જોઈએ નહીં.',
    ],
    'max_digits' => ':attribute ફીલ્ડમાં :max કરતાં વધુ અંકો હોવા જોઈએ નહીં.',
    'mimes' => ':attribute ફીલ્ડ :values પ્રકારની ફાઇલ હોવી જોઈએ.',
    'mimetypes' => ':attribute ફીલ્ડ :values પ્રકારની ફાઇલ હોવી જોઈએ.',
    'min' => [
        'array' => ':attribute ફીલ્ડમાં ઓછામાં ઓછી :min વસ્તુઓ હોવી જોઈએ.',
        'file' => ':attribute ફીલ્ડ ઓછામાં ઓછી :min કિલોબાઇટ હોવું જોઈએ.',
        'numeric' => ':attribute ફીલ્ડ ઓછામાં ઓછી :min હોવું જોઈએ.',
        'string' => ':attribute ફીલ્ડ ઓછામાં ઓછી :min અક્ષરો હોવું જોઈએ.',
    ],
    'min_digits' => ':attribute ફીલ્ડમાં ઓછામાં ઓછી :min અંકો હોવા જોઈએ.',
    'missing' => ':attribute ફીલ્ડ ગુમ હોવું જોઈએ.',
    'missing_if' => ':other :value હોય ત્યારે :attribute ફીલ્ડ ગુમ હોવું જોઈએ.',
    'missing_unless' => ':other :value ન હોય ત્યારે :attribute ફીલ્ડ ગુમ હોવું જોઈએ.',
    'missing_with' => ':values હાજર હોય ત્યારે :attribute ફીલ્ડ ગુમ હોવું જોઈએ.',
    'missing_with_all' => ':values હાજર હોય ત્યારે :attribute ફીલ્ડ ગુમ હોવું જોઈએ.',
    'multiple_of' => ':attribute ફીલ્ડ :value નો ગુણાકાર હોવું જોઈએ.',
    'not_in' => 'પસંદ કરેલ :attribute અમાન્ય છે.',
    'not_regex' => ':attribute ફીલ્ડ ફોર્મેટ અમાન્ય છે.',
    'numeric' => ':attribute ફીલ્ડ સંખ્યા હોવી જોઈએ.',
    'password' => [
        'letters' => ':attribute ફીલ્ડમાં ઓછામાં ઓછી એક અક્ષર હોવું જોઈએ.',
        'mixed' => ':attribute ફીલ્ડમાં ઓછામાં ઓછી એક મોટા અને એક નાના અક્ષર હોવા જોઈએ.',
        'numbers' => ':attribute ફીલ્ડમાં ઓછામાં ઓછી એક સંખ્યા હોવી જોઈએ.',
        'symbols' => ':attribute ફીલ્ડમાં ઓછામાં ઓછી એક ચિહ્ન હોવું જોઈએ.',
        'uncompromised' => 'આપેલ :attribute ડેટા લીકમાં જોવા મળ્યું છે. કૃપા કરીને બીજું પસંદ કરો.',
    ],
    'present' => ':attribute ફીલ્ડ હાજર હોવું જોઈએ.',
    'present_if' => ':other :value હોય ત્યારે :attribute ફીલ્ડ હાજર હોવું જોઈએ.',
    'present_unless' => ':other :value ન હોય ત્યારે :attribute ફીલ્ડ હાજર હોવું જોઈએ.',
    'present_with' => ':values હાજર હોય ત્યારે :attribute ફીલ્ડ હાજર હોવું જોઈએ.',
    'present_with_all' => ':values હાજર હોય ત્યારે :attribute ફીલ્ડ હાજર હોવું જોઈએ.',
    'prohibited' => ':attribute ફીલ્ડ પ્રતિબંધિત છે.',
    'prohibited_if' => ':other :value હોય ત્યારે :attribute ફીલ્ડ પ્રતિબંધિત છે.',
    'prohibited_unless' => ':other :values માં ન હોય ત્યારે :attribute ફીલ્ડ પ્રતિબંધિત છે.',
    'prohibits' => ':attribute ફીલ્ડ :other ને હાજર રહેવા દેતું નથી.',
    'regex' => ':attribute ફીલ્ડ ફોર્મેટ અમાન્ય છે.',
    'required' => ':attribute ફીલ્ડ આવશ્યક છે.',
    'required_array_keys' => ':attribute ફીલ્ડમાં :values માટે એન્ટ્રીઓ હોવી જોઈએ.',
    'required_if' => ':other :value હોય ત્યારે :attribute ફીલ્ડ આવશ્યક છે.',
    'required_if_accepted' => ':other સ્વીકારવામાં આવે ત્યારે :attribute ફીલ્ડ આવશ્યક છે.',
    'required_unless' => ':other :values માં ન હોય ત્યારે :attribute ફીલ્ડ આવશ્યક છે.',
    'required_with' => ':values હાજર હોય ત્યારે :attribute ફીલ્ડ આવશ્યક છે.',
    'required_with_all' => ':values હાજર હોય ત્યારે :attribute ફીલ્ડ આવશ્યક છે.',
    'required_without' => ':values હાજર ન હોય ત્યારે :attribute ફીલ્ડ આવશ્યક છે.',
    'required_without_all' => ':values પૈકી કોઈ પણ હાજર ન હોય ત્યારે :attribute ફીલ્ડ આવશ્યક છે.',
    'same' => ':attribute ફીલ્ડ :other સાથે મેળ ખાતું હોવું જોઈએ.',
    'size' => [
        'array' => ':attribute ફીલ્ડમાં :size વસ્તુઓ હોવી જોઈએ.',
        'file' => ':attribute ફીલ્ડ :size કિલોબાઇટ હોવું જોઈએ.',
        'numeric' => ':attribute ફીલ્ડ :size હોવું જોઈએ.',
        'string' => ':attribute ફીલ્ડ :size અક્ષરોનું હોવું જોઈએ.',
    ],
    'starts_with' => ':attribute ફીલ્ડ નીચેના પૈકી એક સાથે શરૂ થવું જોઈએ: :values.',
    'string' => ':attribute ફીલ્ડ સ્ટ્રિંગ હોવું જોઈએ.',
    'timezone' => ':attribute ફીલ્ડ માન્ય ટાઈમઝોન હોવું જોઈએ.',
    'unique' => ':attribute પહેલેથી જ લેવામાં આવ્યું છે.',
    'uploaded' => ':attribute અપલોડ કરવામાં નિષ્ફળ ગયું.',
    'uppercase' => ':attribute ફીલ્ડ મોટા અક્ષરોમાં હોવું જોઈએ.',
    'url' => ':attribute ફીલ્ડ માન્ય URL હોવું જોઈએ.',
    'ulid' => ':attribute ફીલ્ડ માન્ય ULID હોવું જોઈએ.',
    'uuid' => ':attribute ફીલ્ડ માન્ય UUID હોવું જોઈએ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];