{extends 'tpl.msEmail'}

{block 'title'}
    {'ms2_email_subject_paid_user' | lexicon : $order}
    {'!msdoEmail' | snippet : [
        'id' => {$id}
    ]}
{/block}