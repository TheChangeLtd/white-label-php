<?php
return [
    'rules__title' => 'AML',
    'aml_rules' => 'AML Policy',
    'read_aml_rules' => 'Please read our aml policy before using the service',

    'aml_policy_intro' => 'This Anti-Money Laundering Policy (hereinafter "AML Policy" or "Policy") outlines the key principles and procedures that %name% ("%name%", "our service", "we", "us") follows to prevent illegal activities and ensure compliance with AML (Anti-Money Laundering) and KYC (Know Your Customer) requirements.',

    'aml_measures_title' => '1. AML Measures',
    'aml_measures_description' => 'We strive to protect our clients from fraudulent activities. To achieve this, we have established an integrated system and set of AML procedures that include an automated risk-based approach and adjustable exchange limits.',

    'aml_system_title' => '1.1 AML System',
    'aml_system_description' => 'If a transaction is flagged as high risk, it is temporarily suspended, and additional checks are initiated. Users whose transactions are on hold will be required to create an account (if acting as guests) and complete basic KYC verification to proceed with the transaction.',

    'aml_procedures_title' => '1.2 AML Procedures',
    'aml_procedures_description' => 'Our AML procedures include verifying the source of funds and ensuring that clients comply with legal and service requirements. If a transaction exceeds a predefined risk threshold, the system may trigger actions such as KYC requests, source of funds (SOF) verification, manual reviews, transaction suspension, reporting, or account restrictions.',

    'consent_guarantee_title' => '2. Consent Guarantee',
    'consent_guarantee_description' => 'By using our service, you agree to undergo KYC verification. During this process, we or our partners may request documents and information to confirm your identity, verify the source of funds, and ensure compliance with legal requirements.',

    'consent_verification_items' => [
        'photo_id' => 'A high-quality photo of your ID or passport.',
        'user_photo' => 'A photo of yourself to match with the provided ID document.',
        'real_time_check' => 'Real-time verification to confirm compliance.',
        'sof_docs' => 'Documents verifying the source of funds.',
    ],

    'verification_process_title' => '3. Verification Process',
    'verification_steps' => [
        'conduct_verification' => [
            'title' => '3.1 Conducting Verification',
            'description' => '%name% may engage certified third-party companies to analyze documents and conduct checks. These companies are required to adhere to our Privacy Policy and applicable data protection laws.'
        ],
        'data_storage' => [
            'title' => '3.2 Data Storage',
            'description' => 'All provided documents are securely stored in compliance with the law and are not disclosed to third parties without a lawful request from competent authorities.'
        ],
        'positive_result' => [
            'title' => '3.3 Positive Result',
            'description' => 'If the verification is successfully completed, the transaction will be processed automatically.'
        ],
        'negative_result' => [
            'title' => '3.4 Negative Result',
            'description' => 'If a user fails the KYC verification or their data is found in blacklists, the service reserves the right to deny service. Frozen funds may be retained until the investigation is completed or transferred to the authorities.'
        ],
    ],

    'liability_title' => '4. Limitation of Liability',
    'liability_description' => '%name% takes measures to prevent illegal activities, including refusing cooperation with individuals involved in money laundering, terrorism financing, or other unlawful actions. We are not liable for misuse of our services by clients or errors during the detection of suspicious activities.',

    'any_questions' => 'Any Questions?',
    'read_faq_or' => 'Read the FAQ section or',
    'contact_us' => 'Contact us',
];
