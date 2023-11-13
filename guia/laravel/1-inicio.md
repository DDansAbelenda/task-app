# Inicio

### Inicialización del proyecto
Para iniciar el proyecto laravel se utilizó el comando `laravel new project_name`, este comando despliega un grupo de opciones de configuración del proyecto como:

* Elección de un kit de instalación como breezer 
*  Tipo de proyecto, api o web, en el segundo caso elegir entre diferentes opciones como blade (motor de plantillas de laravel), reac, vue, etc. 
*  Elegir la presenecia o no de control de versiones
*  El tipo de gestor de pruebas de php
*  Elegir SGBD

**Nota**: Si utilizamos alguna tecnología fronted en el proyecto se instalará además las dependecias de node definidas en el fichero json

Otra forma de inicializar el proyecto con valores por defecto es el comando: 

```bash
composer create-project --prefer-dist laravel/laravel project_name`
```


