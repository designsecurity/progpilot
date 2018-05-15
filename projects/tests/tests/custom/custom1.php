<?php

function secret()
{
    dev_iam_authenticated();
    
    if (1 == rand()) {
        dev_iam_rights();
    } else {
        nada();
    }
    
    var_dump(dev_retrieve_secret());
    
    //secret();
}

secret();
