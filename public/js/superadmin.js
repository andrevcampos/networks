function checkimagearray() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://netdev.breeze.marketing/wp-json/networkers/v1/member/image-list', true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var array = JSON.parse(xhr.responseText);
                update_image_list(0, array);
            } catch (error) {
                console.error('Failed to parse JSON:', error);
            }
        } else {
            console.error('Failed to fetch data. Status:', xhr.status);
        }
    };
    
    xhr.onerror = function() {
        console.error('Network error occurred');
    };

    xhr.send();
}

function update_image_list(index, array) {

    var imagelabel = document.getElementById('imagelabel');

    if(index >= array.length){
        imagelabel.innerHTML = "Done!";
        return;
    }

    let nextnumber = index + 1;
    
    imagelabel.innerHTML = "Loading... ( " + nextnumber + "/" + array['images'].length + " )";
    var url = 'https://netdev.breeze.marketing/wp-json/networkers/v1/member/upload-image?postid=' + array['images'][index][0] + '&imageid=' + array['images'][index][1];

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            let newindex = index + 1;
            update_image_list(newindex, array)
        } else {
            console.error('error occurred');
            let newindex = index + 1;
            update_image_list(newindex, array)
        }
    };
    
    xhr.onerror = function() {
        console.error('Network error occurred');
        let newindex = index + 1;
        update_image_list(newindex, array)
    };

    xhr.send();

    // Implement your code to display the image list here.
}

function checklogoarray() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://netdev.breeze.marketing/wp-json/networkers/v1/member/logo-list', true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var array = JSON.parse(xhr.responseText);
                update_logo_list(0, array);
            } catch (error) {
                console.error('Failed to parse JSON:', error);
            }
        } else {
            console.error('Failed to fetch data. Status:', xhr.status);
        }
    };
    
    xhr.onerror = function() {
        console.error('Network error occurred');
    };

    xhr.send();
}

function update_logo_list(index, array) {

    var logolabel = document.getElementById('logolabel');

    if(index >= array['total']){
        logolabel.innerHTML = "Done!";
        return;
    }

    let nextnumber = index + 1;
    
    logolabel.innerHTML = "Loading... ( " + nextnumber + "/" + array['total'] + " )";
    var url = 'https://netdev.breeze.marketing/wp-json/networkers/v1/member/upload-logo?postid=' + array['logos'][index][0] + '&logoid=' + array['logos'][index][1];

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            let newindex = index + 1;
            update_logo_list(newindex, array)
        } else {
            console.error('error occurred');
            let newindex = index + 1;
            update_logo_list(newindex, array)
        }
    };
    
    xhr.onerror = function() {
        console.error('Network error occurred');
        let newindex = index + 1;
        update_logo_list(newindex, array)
    };

    xhr.send();

    // Implement your code to display the image list here.
}


jQuery(document).ready(function($) {
    $('#deleteImagesButton').click(function() {
        // Send an AJAX request to execute the PHP function
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'delete_images' // Action name to execute in PHP
            },
            success: function(response) {
                // Handle the success response here, if needed
                alert('Images deleted successfully.');
            },
            error: function() {
                // Handle any errors here, if needed
                alert('Error deleting images.');
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#deleteMembersButton').click(function() {
        // Send an AJAX request to execute the PHP function
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'delete_members' // Action name to execute in PHP
            },
            success: function(response) {
                // Handle the success response here, if needed
                alert('Members deleted successfully.');
            },
            error: function() {
                // Handle any errors here, if needed
                alert('Error deleting members.');
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#addMembersButton').click(function() {
        // Send an AJAX request to execute the PHP function
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'add_members' // Action name to execute in PHP
            },
            success: function(response) {
                // Handle the success response here, if needed
                alert('Members added successfully.');
            },
            error: function() {
                // Handle any errors here, if needed
                alert('Error adding members.');
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#updateMemberImagesButton').click(function() {
        // Send an AJAX request to execute the PHP function
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'update_member_images' // Action name to execute in PHP
            },
            success: function(response) {
                // Handle the success response here, if needed
                alert('Members Images updated successfully.');
            },
            error: function() {
                // Handle any errors here, if needed
                alert('Error updating images.');
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#updateMemberLogosButton').click(function() {
        // Send an AJAX request to execute the PHP function
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'update_member_logo' // Action name to execute in PHP
            },
            success: function(response) {
                // Handle the success response here, if needed
                alert('Members logos updated successfully.');
            },
            error: function() {
                // Handle any errors here, if needed
                alert('Error updating logos.');
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#removeIndustryButton').click(function() {
        // Send an AJAX request to execute the PHP function
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'IndustryRemove' // Action name to execute in PHP
            },
            success: function(response) {
                // Handle the success response here, if needed
                alert('Industry removed successfully.');
            },
            error: function() {
                // Handle any errors here, if needed
                alert('Error deleting industry.');
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#addIndustryButton').click(function() {
        // Send an AJAX request to execute the PHP function
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'IndustryAdd' // Action name to execute in PHP
            },
            success: function(response) {
                // Handle the success response here, if needed
                alert('Industry added successfully.');
            },
            error: function() {
                // Handle any errors here, if needed
                alert('Error adding industry.');
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#updateIDIndustryButton').click(function() {
        // Send an AJAX request to execute the PHP function
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'IndustryUpdateID' // Action name to execute in PHP
            },
            success: function(response) {
                // Handle the success response here, if needed
                alert('Industry ID Update successfully.');
            },
            error: function() {
                // Handle any errors here, if needed
                alert('Error Updating industry ID.');
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#deleteGroupButton').click(function() {
        // Send an AJAX request to execute the PHP function
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'GroupDelete' // Action name to execute in PHP
            },
            success: function(response) {
                // Handle the success response here, if needed
                alert('Groups deleted successfully.');
            },
            error: function() {
                // Handle any errors here, if needed
                alert('Error deleting groups.');
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#addGroupButton').click(function() {
        // Send an AJAX request to execute the PHP function
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'GroupAdd' // Action name to execute in PHP
            },
            success: function(response) {
                // Handle the success response here, if needed
                alert('Groups added successfully.');
            },
            error: function() {
                // Handle any errors here, if needed
                alert('Error adding groups.');
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#updateidGroupButton').click(function() {
        // Send an AJAX request to execute the PHP function
        $.ajax({
            url: ajaxurl, // WordPress AJAX URL
            type: 'POST',
            data: {
                action: 'GroupUpdateID' // Action name to execute in PHP
            },
            success: function(response) {
                // Handle the success response here, if needed
                alert('Groups Ids successfully update.');
            },
            error: function() {
                // Handle any errors here, if needed
                alert('Error updating the groups ids.');
            }
        });
    });
});