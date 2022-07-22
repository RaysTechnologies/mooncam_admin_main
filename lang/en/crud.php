<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'amount_conversions' => [
        'name' => 'Amount Conversions',
        'index_title' => 'AmountConversions List',
        'new_title' => 'New Amount conversion',
        'create_title' => 'Create AmountConversion',
        'edit_title' => 'Edit AmountConversion',
        'show_title' => 'Show AmountConversion',
        'inputs' => [
            'token' => 'Token',
            'amount' => 'Amount',
            'unit' => 'Unit',
            'symbol' => 'Symbol',
            'user_id' => 'User',
        ],
    ],

    'all_bank_details' => [
        'name' => 'All Bank Details',
        'index_title' => 'AllBankDetails List',
        'new_title' => 'New Bank details',
        'create_title' => 'Create BankDetails',
        'edit_title' => 'Edit BankDetails',
        'show_title' => 'Show BankDetails',
        'inputs' => [
            'country' => 'Country',
            'host_profile_id' => 'Host Profile',
        ],
    ],

    'call_prices' => [
        'name' => 'Call Prices',
        'index_title' => 'CallPrices List',
        'new_title' => 'New Call price',
        'create_title' => 'Create CallPrice',
        'edit_title' => 'Edit CallPrice',
        'show_title' => 'Show CallPrice',
        'inputs' => [
            'video_call' => 'Video Call',
            'live_streaming' => 'Live Streaming',
            'video_call_price_limit' => 'Video Call Price Limit',
            'live_streaming_call_price_limit' =>
                'Live Streaming Call Price Limit',
            'photo_price' => 'Photo Price',
            'host_profile_id' => 'Host Profile',
        ],
    ],

    'country_lists' => [
        'name' => 'Country Lists',
        'index_title' => 'CountryLists List',
        'new_title' => 'New Country list',
        'create_title' => 'Create CountryList',
        'edit_title' => 'Edit CountryList',
        'show_title' => 'Show CountryList',
        'inputs' => [
            'country' => 'Country',
            'user_id' => 'User',
        ],
    ],

    'free_token_transactions' => [
        'name' => 'Free Token Transactions',
        'index_title' => 'FreeTokenTransactions List',
        'new_title' => 'New Free token transaction',
        'create_title' => 'Create FreeTokenTransaction',
        'edit_title' => 'Edit FreeTokenTransaction',
        'show_title' => 'Show FreeTokenTransaction',
        'inputs' => [
            'free_token' => 'Free Token',
            'host_profile_id' => 'Host Profile',
        ],
    ],

    'galleries' => [
        'name' => 'Galleries',
        'index_title' => 'Galleries List',
        'new_title' => 'New Gallery',
        'create_title' => 'Create Gallery',
        'edit_title' => 'Edit Gallery',
        'show_title' => 'Show Gallery',
        'inputs' => [
            'photo' => 'Photo',
            'host_profile_id' => 'Host Profile',
        ],
    ],

    'gift_lists' => [
        'name' => 'Gift Lists',
        'index_title' => 'GiftLists List',
        'new_title' => 'New Gift list',
        'create_title' => 'Create GiftList',
        'edit_title' => 'Edit GiftList',
        'show_title' => 'Show GiftList',
        'inputs' => [
            'name' => 'Name',
            'image' => 'Image',
            'token' => 'Token',
            'user_id' => 'User',
        ],
    ],

    'gift_transactions' => [
        'name' => 'Gift Transactions',
        'index_title' => 'GiftTransactions List',
        'new_title' => 'New Gift transaction',
        'create_title' => 'Create GiftTransaction',
        'edit_title' => 'Edit GiftTransaction',
        'show_title' => 'Show GiftTransaction',
        'inputs' => [
            'reciever_id' => 'Reciever Id',
            'sender_id' => 'Sender Id',
            'gift_id' => 'Gift Id',
            'gift_name' => 'Gift Name',
            'token' => 'Token',
            'host_profile_id' => 'Host Profile',
        ],
    ],

    'recharge_amounts' => [
        'name' => 'Recharge Amounts',
        'index_title' => 'RechargeAmounts List',
        'new_title' => 'New Recharge amount',
        'create_title' => 'Create RechargeAmount',
        'edit_title' => 'Edit RechargeAmount',
        'show_title' => 'Show RechargeAmount',
        'inputs' => [
            'amount' => 'Amount',
            'token' => 'Token',
            'unit' => 'Unit',
            'user_id' => 'User',
        ],
    ],

    'report_and_blocks' => [
        'name' => 'Report And Blocks',
        'index_title' => 'ReportAndBlocks List',
        'new_title' => 'New Report and block',
        'create_title' => 'Create ReportAndBlock',
        'edit_title' => 'Edit ReportAndBlock',
        'show_title' => 'Show ReportAndBlock',
        'inputs' => [
            'blocked_user_id' => 'Blocked User Id',
            'blocked_user_name' => 'Blocked User Name',
            'host_profile_id' => 'Host Profile',
        ],
    ],

    'video_call_transactions' => [
        'name' => 'Video Call Transactions',
        'index_title' => 'VideoCallTransactions List',
        'new_title' => 'New Video call transaction',
        'create_title' => 'Create VideoCallTransaction',
        'edit_title' => 'Edit VideoCallTransaction',
        'show_title' => 'Show VideoCallTransaction',
        'inputs' => [
            'reciever_id' => 'Reciever Id',
            'sender_id' => 'Sender Id',
            'call_duration' => 'Call Duration',
            'token_charge' => 'Token Charge',
            'host_profile_id' => 'Host Profile',
        ],
    ],

    'wallets' => [
        'name' => 'Wallets',
        'index_title' => 'Wallets List',
        'new_title' => 'New Wallet',
        'create_title' => 'Create Wallet',
        'edit_title' => 'Edit Wallet',
        'show_title' => 'Show Wallet',
        'inputs' => [
            'token' => 'Token',
            'free_token' => 'Free Token',
            'host_profile_id' => 'Host Profile',
        ],
    ],

    'withdrawl_transactions' => [
        'name' => 'Withdrawl Transactions',
        'index_title' => 'WithdrawlTransactions List',
        'new_title' => 'New Withdrawl transaction',
        'create_title' => 'Create WithdrawlTransaction',
        'edit_title' => 'Edit WithdrawlTransaction',
        'show_title' => 'Show WithdrawlTransaction',
        'inputs' => [
            'token' => 'Token',
            'total_amount' => 'Total Amount',
            'recieved_amount' => 'Recieved Amount',
            'commision' => 'Commision',
            'status' => 'Status',
            'date' => 'Date',
            'host_profile_id' => 'Host Profile',
        ],
    ],

    'host_profiles' => [
        'name' => 'Host Profiles',
        'index_title' => 'HostProfiles List',
        'new_title' => 'New Host profile',
        'create_title' => 'Create HostProfile',
        'edit_title' => 'Edit HostProfile',
        'show_title' => 'Show HostProfile',
        'inputs' => [
            'name' => 'Name',
            'age' => 'Age',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'gender' => 'Gender',
            'photo' => 'Photo',
            'fans_count' => 'Fans Count',
            'followup_count' => 'Followup Count',
            'visitor_count' => 'Visitor Count',
            'firebase_id' => 'Firebase Id',
            'token_rate_videocall' => 'Token Rate Videocall',
            'token_rate_groupcall' => 'Token Rate Groupcall',
            'user_id' => 'User',
        ],
    ],
];
