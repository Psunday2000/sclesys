<?php

// Check if the Department form is submitted
function isDepartmentFormSubmitted($userId)
{
    // Logic to check if the Department form is submitted for the given user
    // You may query your database or use any other logic as needed
    // Example: Check if an entry exists in the clearance_point table for the Department form
    return ClearancePoint::where('user_id', $userId)
        ->where('unit_id', DepartmentUnitId)
        ->exists();
}

// Check if every other form is submitted before the Bursary form
function canSubmitBursaryForm($userId)
{
    // Logic to check if every other form is submitted for the given user
    // You may query your database or use any other logic as needed
    // Example: Check if entries exist in the clearance_point table for all previous forms
    return isDepartmentFormSubmitted($userId) &&
        ClearancePoint::where('user_id', $userId)
            ->where('unit_id', OtherFormsUnitId)
            ->exists();
}

// Check if the Records form can be activated
function canActivateRecordsForm($userId)
{
    // Logic to check if the Records form can be activated for the given user
    // You may query your database or use any other logic as needed
    // Example: Check if entries exist in the clearance_point table for all previous forms
    return canSubmitBursaryForm($userId) &&
        !ClearancePoint::where('user_id', $userId)
            ->where('unit_id', RecordsFormUnitId)
            ->exists();
}

?>
