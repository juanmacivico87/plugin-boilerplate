# Plugin sample

Este repositorio contiene un boilerplate para desarrollar plugins para WordPress a partir del mismo.

## Requisitos mínimos

Para poder desarrollar tu propio plugin a partir de este ejemplo, vas a necesitar, como mínimo:

- [WordPress](https://es.wordpress.org/download/)
- PHP 7.4
- [Composer](https://getcomposer.org/download/)
- Ganas de desarrollar un plugin para WordPress

## Primeros pasos para crear tu plugin

1. Entra en la [URL del repositorio](https://github.com/juanmacivico87/plugin-boilerplate). Seguramente, si estás leyendo esto, ya estarás en ella.
2. Ve a la carpeta plugins de tu instalación de WordPress (preferiblemente, en un entorno de desarrollo).
3. Abre una consola de comandos en esta ruta y ejecuta el comando ```git clone https://github.com/juanmacivico87/plugin-boilerplate.git```. Esto creará un clon del boilerplate en tu carpeta de plugins.
4. Renombra la carpeta del plugin descargado con el slug que tú le quieras dar, en minúscula y separado por guiones (por ejemplo: "my-custom-plugin").
5. Renombra el archivo principal del plugin descargado con el slug del paso anterior (por ejemplo: "my-custom-plugin.php").
6. Abre tu editor de código favorito y reemplaza las siguientes cadenas de texto en todo el plugin:
    - **plugin-boilerplate** por el slug que elegiste en el paso 4.
    - **PluginBoilerplate** por el nombre de espacio que quieras dar a tu plugin (por ejemplo: "MyCustomPlugin").
    - **PLUGIN_BOILERPLATE** por el prefijo que desees que tengan las constantes globales de tu plugin (por ejemplo: "MY_CUSTOM_PLUGIN").
    - **$plugin_boilerplate** por el prefijo que desees que tengan las variables globales de tu plugin (por ejemplo: "$my_custom_plugin"). No te olvides de incluir el símbolo del Dólar ($) en ambas cadenas, tanto la original como la nueva.
7. Abre el archivo principal del plugin y sustituye las cabeceras del plugin con la información que tú desees. Cambia también los valores de la constante de la versión y del nombre del plugin por los mismos que hayas indicado en las cabeceras.
8. Revisa los archivos del plugin para verificar que no queda rastro de las cadenas de ejemplo.
9. Guarda todos los cambios que has hecho en todos los archivos.
10. Elimina la carpeta ".git" que viene por defecto.

Y, voilà!!! Ya está todo listo para que empieces a desarrollar tu plugin.

## Estructura de archivos

Como partidario y defensor de la programación orientada a objetos, he querido crear una estructura de archivos que permitan seguir esa práctica, ya que considero que es una forma muy limpia de desarrollar, así como de mantener y escalar cualquier proyecto, utilizando cada archivo y cada carpeta únicamente para las funcionalidades concretas que debe tener.

Antes de ponerte a desarrollar, te recomiendo que le eches un vistazo a los archivos y las carpetas que te dejo en el boilerplate.

De todas formas, para ayudarte, te hago un resumen de los archivos y carpetas que vas a encontrar en el plugin de ejemplo:

- **plugin-boilerplate.php:** Este es el archivo principal del plugin. En él, se entablecen las cabeceras con la información de dicho plugin, constantes que necesita el plugin para ciertas funcionalidades y funciones que se ejecutan al activar, desactivar e instalar el plugin. Las constantes definidas en este archivo son:
    - **PLUGIN_BOILERPLATE_LANG_DIR:** Te permite indicar la ruta de la carpeta en la que almacenarás los ficheros .po y .mo con las traducciones del plugin.
    - **PLUGIN_BOILERPLATE_FILE:** Te permite indicar ruta absoluta al archivo principal del plugin.
    - **PLUGIN_BOILERPLATE_DIR:** Te permite indicar ruta absoluta a la carpeta del plugin. Esta constante te puede ayudar a la hora de hacer includes de otros archivos.
    - **PLUGIN_BOILERPLATE_URL:** Te permite indicar la URL absoluta de la carpeta del plugin.
    - **PLUGIN_BOILERPLATE_PUBLIC_ASSETS:** Te permite indicar la URL absoluta de la carpeta de los assets del plugin. Esta constante te puede ayudar a la hora de enconlar tus archivos CSS y JS, para el frontend.
    - **PLUGIN_BOILERPLATE_ADMIN_ASSETS:** Te permite indicar la URL absoluta de los assets del panel de administración del plugin. Esta constante te puede ayudar a la hora de enconlar tus archivos CSS y JS, para el panel de administración.
    - **PLUGIN_BOILERPLATE_NAME:** Te permite indicar el nombre plugin. El valor de esta constante es el mismo que el de la cabecera de la "Name".
    - **PLUGIN_BOILERPLATE_VERSION:** Te permite indicar la versión de tu plugin. El valor de esta constante es el mismo que el de la cabecera de la "Version".
    - **PLUGIN_BOILERPLATE_TEXTDOMAIN:** Te permite indicar el nombre de dominio de tu plugin. El valor de esta constante es el mismo que el de la cabecera de la "Text Domain".
- **admin:** Contiene todos los recursos que necesita tu plugin en el panel de administración.
    - **css:** Aquí podrás incluir los archivos CSS que tu plugin necesita para visualizarse correctamente en el panel de administración.
    - **fonts:** Aquí podrás incluir las tipografías requeridas por tu plugin en el panel de administración.
    - **images:** Aquí podrás incluir aquellas imágenes que tu plugin necesita en el panel de administración, tales como iconos, logos, etc.
    - **js:** Aquí podrás incluir los archivos Javascript de las funcionalidades que tu plugin requiera en el panel de administración.
- **public:** Contiene todos los recursos que necesita tu plugin en el front.
    - **css:** Aquí podrás incluir los archivos CSS que tu plugin necesita para visualizarse correctamente en el front.
    - **fonts:** Aquí podrás incluir las tipografías requeridas por tu plugin en el front.
    - **images:** Aquí podrás incluir aquellas imágenes que tu plugin necesita en el front, tales como iconos, logos, etc.
    - **js:** Aquí podrás incluir los archivos Javascript de las funcionalidades que tu plugin requiera en el front.
- **languages:** En esta carpeta, se almacenarán todos los archivos *.po y *.mo, necesarios para la correcta traducción del plugin.
- **src:** 
    - **App:**
        - **App.php:** En este archivo se establece una clase con la configuración del plugin. En ella, se instancian todas las clases con las funcionalidades del plugin, se indica a la instalación de WordPress el nombre de dominio que debe buscar para traducir el plugin, se encolan los ficheros CSS y Javascript globales que el plugin necesita, y se declaran las funciones que se llaman desde el archivo principal del plugin al activar, desactivar y borrar el plugin.
    - **Providers:** Con el objetivo de conseguir que WordPress sea una dependencia del plugin y no al revés, esta carpeta contiene clases que engloban las funciones de las dependencias que el plugin necesita, pero que se cargan a través de WordPress, tales como plugins de terceros, temas de terceros o la propia instalación de WordPress. En la actualidad, el boilerplate solamente tiene dependencia con ACF PRO y con WordPress, pero si para tu desarrollo necesitas alguna más, siéntente libre de crearla. Igualmente, si hay algún método, hook o cualquier elemento que sea necesario para tu desarrollo y aún no existe, te invito a que lo añadas a su clase correspondiente y solicites una Pull Request para integrarlo dentro del boilerplate.
        - **WordPress:** En este directorio se definen constantes con los hooks y opciones de WordPress, así como métodos que engloban las funciones de WordPress y dependencias de plugins de terceros.
            - **Resources:** Contiene clases abstractas que facilitan el desarrollo de las distintas funcionalidades del plugin.
            - **WpActions.php:** Clase en la que se definen las constantes con los hooks de WordPress.
            - **WpOptions.php:** Clase en la que se definen las constantes con los nombres de las opciones de la tabla "options" de WordPress.
            - **WpProvider.php:** Clase en la que se definen los métodos que engloban las funciones de WordPress. Muy útil para realizar test con PHPUnit sin la necesidad de ejecutar WordPress.
            - **WpDependencies.php:** Clase en la que se definen los plugins de terceros que necesita el plugin para funcionar, así como las versiones de PHP y de WordPress. En caso de que no se cumplan con estos requisitos, el plugin no se activará.
        - **AdvancedCustomFields:** En este directorio se definen constantes con los hooks y opciones del plugin ACF PRO, así como métodos que engloban las funciones de dicho plugin.
            - **Resources:** Contiene clases abstractas que facilitan el desarrollo de las distintas funcionalidades del plugin.
            - **AcfActions.php:** Clase en la que se definen las constantes con los hooks de ACF.
            - **AcfProvider.php:** Clase en la que se definen los métodos que engloban las funciones de ACF. Muy útil para realizar test con PHPUnit sin la necesidad de ejecutar WordPress.
            - **AcfLocations.php:** Clase en la que se definen las distintas localizaciones a las que se pueden asignar grupos de campos de ACF.
    - **Modules:** Contiene las clases de PHP que desarrollarás para añadir las funcionalidades de tu plugin a la web en la que se instale el mismo.
        - **Endpoints:** Con la llegada de la API Rest de WordPress, es posible interactuar con nuestra web desde un servicio externo, como puede ser una app o un front hecho con un framework de Javascript. En esta carpeta, podrás crear tus propios endpoints para que devuelvan los datos que necesite tu aplicación externa... o interna.
        - **FieldsGroup:** Una de las carácteristicas de WordPress, es que permite la creación de campos personalizados para almacenar metadatos para las distintas entidades que incorpora el CMS en su core. En esta carpera puedes crear tantos grupos de campos como necesites para tus tipos de contenido, taxonomías, páginas de opciones, perfiles de usuario,... En fin, para lo que necesites.
        - **PostTypes:** WordPress trae incluidos en su núcleo una serie de tipos de contenido. Los más conocidos son las páginas y las entradas, pero también lo son los archivos de la biblioteca, los menús, etc. Además, te ofrece la posibilidad de que puedas tener los tuyos propios, como pueden ser para crear fichas de producto (como hace WooCommerce), cursos (como es el caso de Sensei) y todo lo que se te pase por la cabeza. Guarda en esta carpeta todos los tipos de contenido personalizados que desarrolles.
        - **RestFields:** Pese a que los endpoints que trae por defecto la API Rest de WordPress te pueden proporcionar mucha información sobre tu sitio web, hay veces que esta información no es suficiente. Como alternativa a crear tu propio endpoint, WordPress te ofrece la posibilidad de añadir un nuevo campo a los endpoints que ya tiene integrados. En esta carpeta, podrás crear tus campos personalizados e incluirlos en el endpoint que desees.
        - **Roles:** WordPress, por defecto, incorpora cinco tipos de roles, con sus respectivas restricciones, pero, ¿qué ocurre si necesitas un sexto tipo de rol con unas restricciones específicas? En esta carpeta, podrás crear tus roles personalizados para asignárselos a los usuarios que desees.
        - **SettingsPages:** La mayoría de plugins o temas incorporan una página de ajustes en la que poder configurar parámetros, incluir claves,... En esta carpeta, podrás crear tus propias páginas de ajustes y asignarles los campos y opciones que creas necesarios para tu plugin.
        - **Taxonomies:** WordPress también trae incluidas en su núcleo taxonomías, que te permiten clasificar los contenidos de un tipo concreto o de varios tipos. Algunas de estas taxonomías permiten una jerarquía, como es el caso de las categorías de una entrada, que dan la posibilidad de crear sub-categorías. Otras, por el contrario, no permiten dicha jerarquía, como es el caso de las etiquetas de una entrada. En esta carpeta podrás tener todas las taxonomías personalizadas que necesites.
    - **Infrastructure:** En este directorio puedes crear clases para definir información que te sea útil en el resto de clases del plugin, tal como nombres de campos personalizados o hooks a medida que crees dentro de tu plugin.
    - **Services:** En este directorio puedes crear clases para definir métodos que sean de utilidad para el desarrollo del plugin y que puedan ser utilizados desde cualquier otra clase, como por ejemplo un método que se encargue de realizar una petición a un endpoint y devolver el resultado de una forma concreta.
- **vendor:** En esta carpeta, se almacenarán todas las dependencias que se instalen en el plugin al ejecutar el comando "composer install". Recuerda que debes incluirla en el archivo **.gitignore**.
- **composer.json:** Este es el archivo de configuración de Composer. En él, encontrarás las librerías y dependencias que el plugin necesita para funcionar. Quizá necesites añadir las tuyas propias en función del plugin que vayas a desarrollar.
- **composer.lock:** Este archivo contiene las dependencias que se han instalado actualmente en tu plugin a través de composer, así como las versiones de cada una de ellas. Puedes modificar su contenido ejecutando el comando "composer update" en una consola desde la raíz del plugin.
- **.gitignore:** Este archivo contiene aquellos archivos que deben ser ignorados por Git y, por tanto no se deben subir al repositorio.

## Nota informativa

Este es un proyecto Open Source, así que siéntete libre de descargarlo, utilizarlo y proponer nuevas características y funcionalidades.