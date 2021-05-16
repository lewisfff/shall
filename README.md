
## Shall

A Laravel template that makes a gallery of my images when I...

__requires imagemagick__

- Upload them to /photos (any subdirectory structure is fine)
- Run the artisan command 'process' to process the images and build the gallery cache
- symlink /photos to /public/source
- run php artisan storage:link
