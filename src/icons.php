<?php

$register_icon = "<i class='fa-solid fa-cash-register'></i>";
$error_icon = "<i class='fa-solid fa-circle-exclamation'></i>";
$success_icon = "<i class='fa-solid fa-circle-check'></i>";
$warning_c_icon = "<i class='fa-solid fa-circle-info action-icon amplify text-warning'></i>";
$warning_t_icon = "<i class='fa-solid fa-triangle-exclamation'></i>";
$plus_icon = "<i class='fa-solid fa-plus'></i>";
$rotate_icon = "<i class='fa-solid fa-rotate-left'></i>";
$glass_icon = "<i class='fa-solid fa-magnifying-glass'></i>";
$trash_icon = "<i class='fa-solid fa-trash-can action-icon amplify icon-delete text-danger'></i>";
$edit_icon = "<i class='fa-solid fa-pen-to-square'></i>";
$chevron_left = "<i class='fa-solid fa-chevron-left'></i>";
$pen_clip = "<i class='fa-solid fa-pen-clip'></i>";

?>

<style>
i {
margin-left: 5px;
margin-right: 5px;

&.fa-cash-register {
    margin-right: 15px;
}

&.action-icon {
    font-size: 24px;
    transition: all 0.5s ease;
    cursor: pointer;
    
}

&.amplify {
    cursor: pointer;
    &:hover {
        transform: scale(1.2);
    }
}
}
</style>