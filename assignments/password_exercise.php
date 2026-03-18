function validate_password($pw){
    if (strlen($pw) > 12):
        echo password_hash('sha256', $pw) 
    else:
        echo false
    endif;
}