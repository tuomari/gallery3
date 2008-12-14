<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2008 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
class Watermark_Controller extends Controller {
  public function load() {
    $form = watermark::get_watermark_form();
    if ($form->validate()) {
        $file = $_POST["file"];
        
        // Format of the file is config["upload.directory"]/uploadfile-hash-filename.
        $index = strrpos($file, "-");
        $watermark_target = VARPATH . substr($file, strrpos($file, "-") + 1);
        if (rename($file, $watermark_target)) {
          module::set_var("watermark", "watermark_image_path", $watermark_target);

          $form->success = _("Watermark saved");
        } else {
          // @todo set and error message
        }
    }

    print $form;
  }
}