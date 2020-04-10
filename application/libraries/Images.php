<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Images
{
	
    private $_ci;
	
    public $image_library = 'GD2';
	
    public $library_path = null;

    public function __construct ()
    {
        // Instantiate the CI libraries so we can work with them
        $this->_ci = & get_instance();
        
        // Load image library if necessary
        if (! isset($this->_ci->image_lib)) {
            $this->_ci->load->library('image_lib');
        }
        
        // Set image library and path from settings in configuration file.
        // If you did not set these settings in a config file the settings remain default.
        config_item('image_library') === FALSE || $this->image_library = config_item('image_library');
        config_item('library_path') === FALSE || $this->library_path = config_item('library_path');
    }
	
    function resize ($originalFile, $newFile, $newWidth, $newHeight, $enlarge)
    {
		
		// Abort if image does not exist
        if (! file_exists($originalFile) || ! is_file($originalFile)) {
            return FALSE;
        }
        
        // If we should not enlarge we need to check the size of the original image
        if ($enlarge == FALSE) {
            
            // Do not resize if the image is already smaller than $newWidth and $newHeight
            $imgData = $this->getSize($originalFile);
            if ($imgData['width'] <= $newWidth && $imgData['height'] <= $newHeight) {
                if ($newFile == '') {
                    
                    return FALSE;
                }
                else {
                    // Delete existing file, if the destination file is not the
                    // original file (otherwise we'd delete our source file, too)
                    if (file_exists($newFile) && is_file($newFile) && $newFile != $originalFile) {
                        unlink($newFile);
                    }
                    
                    // Copy the image to the new path
                    copy($originalFile, $newFile);
                    return FALSE;
                }
            }
        }
        
        // Configure CI image_lib
        $config['image_library'] = $this->image_library;
        $config['library_path'] = $this->library_path;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $newWidth;
        $config['height'] = $newHeight;
        $config['source_image'] = $originalFile;
        if ($newFile) {
            $config['new_image'] = $newFile;
        }
        $this->_ci->image_lib->initialize($config);
        
        // Resize the image
        if (! $this->_ci->image_lib->resize()) {
            show_error($this->_ci->image_lib->display_errors());
        }
        
        // Clear lib so we can perform another image action
        $this->_ci->image_lib->clear();
    }
	
    public function getSize ($image)
    {
        $imgData = getimagesize($image);
        $retval['width'] = $imgData[0];
        $retval['height'] = $imgData[1];
        $retval['mime'] = $imgData['mime'];
        return $retval;
    }
	
}