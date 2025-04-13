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

    'accepted' => ':attribute harus diterima.',
    'accepted_if' => ':attribute harus diterima kalau :other adalah :value.',
    'active_url' => ':attribute harus berupa URL yang valid.',
    'after' => ':attribute harus tanggal setelah :date.',
    'after_or_equal' => ':attribute harus tanggal setelah atau sama dengan :date.',
    'alpha' => ':attribute cuma boleh berisi huruf.',
    'alpha_dash' => ':attribute cuma boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num' => ':attribute cuma boleh berisi huruf dan angka.',
    'array' => ':attribute harus berupa array.',
    'ascii' => ':attribute cuma boleh berisi karakter alfanumerik satu byte dan simbol.',
    'before' => ':attribute harus tanggal sebelum :date.',
    'before_or_equal' => ':attribute harus tanggal sebelum atau sama dengan :date.',
    'between' => [
        'array' => ':attribute harus punya antara :min sampai :max item.',
        'file' => ':attribute harus antara :min sampai :max kilobyte.',
        'numeric' => ':attribute harus antara :min sampai :max.',
        'string' => ':attribute harus antara :min sampai :max karakter.',
    ],
    'boolean' => ':attribute harus true atau false.',
    'can' => ':attribute mengandung nilai yang nggak diizinkan.',
    'confirmed' => 'Konfirmasi :attribute nggak cocok.',
    'contains' => ':attribute kurang nilai yang dibutuhkan.',
    'current_password' => 'Password salah.',
    'date' => ':attribute harus berupa tanggal yang valid.',
    'date_equals' => ':attribute harus tanggal yang sama dengan :date.',
    'date_format' => ':attribute harus sesuai format :format.',
    'decimal' => ':attribute harus punya :decimal angka desimal.',
    'declined' => ':attribute harus ditolak.',
    'declined_if' => ':attribute harus ditolak kalau :other adalah :value.',
    'different' => ':attribute dan :other harus beda.',
    'digits' => ':attribute harus :digits digit.',
    'digits_between' => ':attribute harus antara :min sampai :max digit.',
    'dimensions' => ':attribute punya dimensi gambar yang nggak valid.',
    'distinct' => ':attribute punya nilai duplikat.',
    'doesnt_end_with' => ':attribute nggak boleh diakhiri dengan salah satu dari: :values.',
    'doesnt_start_with' => ':attribute nggak boleh diawali dengan salah satu dari: :values.',
    'email' => ':attribute harus berupa alamat email yang valid.',
    'ends_with' => ':attribute harus diakhiri dengan salah satu dari: :values.',
    'enum' => ':attribute yang dipilih nggak valid.',
    'exists' => ':attribute yang dipilih nggak valid.',
    'extensions' => ':attribute harus punya salah satu ekstensi berikut: :values.',
    'file' => ':attribute harus berupa file.',
    'filled' => ':attribute harus punya nilai.',
    'gt' => [
        'array' => ':attribute harus punya lebih dari :value item.',
        'file' => ':attribute harus lebih besar dari :value kilobyte.',
        'numeric' => ':attribute harus lebih besar dari :value.',
        'string' => ':attribute harus lebih dari :value karakter.',
    ],
    'gte' => [
        'array' => ':attribute harus punya :value item atau lebih.',
        'file' => ':attribute harus lebih besar atau sama dengan :value kilobyte.',
        'numeric' => ':attribute harus lebih besar atau sama dengan :value.',
        'string' => ':attribute harus lebih besar atau sama dengan :value karakter.',
    ],
    'hex_color' => ':attribute harus berupa warna hexadecimal yang valid.',
    'image' => ':attribute harus berupa gambar.',
    'in' => ':attribute yang dipilih nggak valid.',
    'in_array' => ':attribute harus ada di :other.',
    'integer' => ':attribute harus berupa angka bulat.',
    'ip' => ':attribute harus berupa alamat IP yang valid.',
    'ipv4' => ':attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => ':attribute harus berupa alamat IPv6 yang valid.',
    'json' => ':attribute harus berupa string JSON yang valid.',
    'list' => ':attribute harus berupa daftar.',
    'lowercase' => ':attribute harus huruf kecil semua.',
    'lt' => [
        'array' => ':attribute harus punya kurang dari :value item.',
        'file' => ':attribute harus kurang dari :value kilobyte.',
        'numeric' => ':attribute harus kurang dari :value.',
        'string' => ':attribute harus kurang dari :value karakter.',
    ],
    'lte' => [
        'array' => ':attribute nggak boleh punya lebih dari :value item.',
        'file' => ':attribute harus kurang atau sama dengan :value kilobyte.',
        'numeric' => ':attribute harus kurang atau sama dengan :value.',
        'string' => ':attribute harus kurang atau sama dengan :value karakter.',
    ],
    'mac_address' => ':attribute harus berupa alamat MAC yang valid.',
    'max' => [
        'array' => ':attribute nggak boleh punya lebih dari :max item.',
        'file' => ':attribute nggak boleh lebih dari :max kilobyte.',
        'numeric' => ':attribute nggak boleh lebih dari :max.',
        'string' => ':attribute nggak boleh lebih dari :max karakter.',
    ],
    'max_digits' => ':attribute nggak boleh punya lebih dari :max digit.',
    'mimes' => ':attribute harus berupa file dengan tipe: :values.',
    'mimetypes' => ':attribute harus berupa file dengan tipe: :values.',
    'min' => [
        'array' => ':attribute harus punya minimal :min item.',
        'file' => ':attribute harus minimal :min kilobyte.',
        'numeric' => ':attribute harus minimal :min.',
        'string' => ':attribute harus minimal :min karakter.',
    ],
    'min_digits' => ':attribute harus punya minimal :min digit.',
    'missing' => ':attribute harus hilang.',
    'missing_if' => ':attribute harus hilang kalau :other adalah :value.',
    'missing_unless' => ':attribute harus hilang kecuali :other adalah :value.',
    'missing_with' => ':attribute harus hilang kalau :values ada.',
    'missing_with_all' => ':attribute harus hilang kalau :values ada semua.',
    'multiple_of' => ':attribute harus kelipatan dari :value.',
    'not_in' => ':attribute yang dipilih nggak valid.',
    'not_regex' => 'Format :attribute nggak valid.',
    'numeric' => ':attribute harus berupa angka.',
    'password' => [
        'letters' => ':attribute harus punya minimal satu huruf.',
        'mixed' => ':attribute harus punya minimal satu huruf besar dan satu huruf kecil.',
        'numbers' => ':attribute harus punya minimal satu angka.',
        'symbols' => ':attribute harus punya minimal satu simbol.',
        'uncompromised' => ':attribute yang diberikan sudah pernah bocor. Pilih :attribute yang lain.',
    ],
    'present' => ':attribute harus ada.',
    'present_if' => ':attribute harus ada kalau :other adalah :value.',
    'present_unless' => ':attribute harus ada kecuali :other adalah :value.',
    'present_with' => ':attribute harus ada kalau :values ada.',
    'present_with_all' => ':attribute harus ada kalau :values ada semua.',
    'prohibited' => ':attribute dilarang.',
    'prohibited_if' => ':attribute dilarang kalau :other adalah :value.',
    'prohibited_if_accepted' => ':attribute dilarang kalau :other diterima.',
    'prohibited_if_declined' => ':attribute dilarang kalau :other ditolak.',
    'prohibited_unless' => ':attribute dilarang kecuali :other ada di :values.',
    'prohibits' => ':attribute melarang :other untuk ada.',
    'regex' => 'Format :attribute nggak valid.',
    'required' => ':attribute wajib diisi.',
    'required_array_keys' => ':attribute harus punya entri untuk: :values.',
    'required_if' => ':attribute wajib diisi kalau :other adalah :value.',
    'required_if_accepted' => ':attribute wajib diisi kalau :other diterima.',
    'required_if_declined' => ':attribute wajib diisi kalau :other ditolak.',
    'required_unless' => ':attribute wajib diisi kecuali :other ada di :values.',
    'required_with' => ':attribute wajib diisi kalau :values ada.',
    'required_with_all' => ':attribute wajib diisi kalau :values ada semua.',
    'required_without' => ':attribute wajib diisi kalau :values nggak ada.',
    'required_without_all' => ':attribute wajib diisi kalau nggak ada satu pun dari :values.',
    'same' => ':attribute harus sama dengan :other.',
    'size' => [
        'array' => ':attribute harus punya :size item.',
        'file' => ':attribute harus :size kilobyte.',
        'numeric' => ':attribute harus :size.',
        'string' => ':attribute harus :size karakter.',
    ],
    'starts_with' => ':attribute harus diawali dengan salah satu dari: :values.',
    'string' => ':attribute harus berupa string.',
    'timezone' => ':attribute harus berupa zona waktu yang valid.',
    'unique' => ':attribute sudah dipakai.',
    'uploaded' => ':attribute gagal diunggah.',
    'uppercase' => ':attribute harus huruf besar semua.',
    'url' => ':attribute harus berupa URL yang valid.',
    'ulid' => ':attribute harus berupa ULID yang valid.',
    'uuid' => ':attribute harus berupa UUID yang valid.',

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
        'item_id' => [
            'required' => 'Eh ID produknya kemana nih?',
            'exists' => 'Eh, produk ini gaada nih.',
        ],
        'amount' => [
            'required' => 'Jumlah produknya jangan lupa diisi ya!',
            'gte' => 'Jumlah produk minimal harus 1 dong.',
        ],
        'name' => [
            'required' => 'Yuk, isi nama kamu dulu!',
            'string' => 'Nama harus berupa teks, jangan aneh-aneh ya!',
            'max' => 'Nama kamu kepanjangan nih, maksimal 255 karakter aja.',
        ],
        'email' => [
            'required' => 'Email wajib diisi, jangan lupa ya!',
            'string' => 'Email harus berupa teks, jangan pakai simbol aneh.',
            'lowercase' => 'Email harus huruf kecil semua, biar rapi.',
            'email' => 'Format email kamu salah nih, cek lagi ya!',
            'max' => 'Email kamu kepanjangan, maksimal 255 karakter aja.',
            'unique' => 'Email ini udah dipakai, coba yang lain ya!',
        ],
        'whatsapp_number' => [
            'required' => 'Nomor WhatsApp wajib diisi, biar kita bisa kontak kamu!',
            'string' => 'Nomor WhatsApp harus berupa angka, jangan pakai huruf.',
            'max' => 'Nomor WhatsApp kamu kepanjangan, maksimal 15 digit aja.',
            'unique' => 'Nomor WhatsApp ini udah dipakai, coba yang lain ya!',
        ],
        'password' => [
            'required' => 'Kata sandi wajib diisi, jangan lupa bikin yang kuat ya!',
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

    'attributes' => [
        'amount' => 'Jumlah'
    ],

];
