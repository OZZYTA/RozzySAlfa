<?php
/**
 * We just want to hash our password using the current DEFAULT algorithm.
 * This is presently BCRYPT, and will produce a 60 character result.
 *
 * Beware that DEFAULT may change over time, so you would want to prepare
 * By allowing your storage to expand past 60 characters (255 would be good)
 */
echo password_verify("$2y$10$CJB9l8CW3irpytM8uHOS9.AtiOfvIrM1xCGzrHI93gISOWeMZmLXO", PASSWORD_DEFAULT);
?>