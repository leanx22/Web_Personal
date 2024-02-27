<h1>PORFOLIO PERSONAL</h1>
<hr>
<h2> Sobre el proyecto:</h2>
<p>Tal como dice el título, se trata de mi página web personal, o como muchos le dicen, mi porfolio.
Como desarrollador web me veía en la obligación de programar mi propia web que muestre los distintos proyectos realizados a lo largo de mi carrera como estudiante, y próximamente como profesional. Sin embargo, me parecía un poco aburrida la idea de sólo utilizar <strong>HTML y Tailwind</strong> para crear una página simple que no se me presente como un <strong>"desafío"</strong>, por lo que decidí llevar la idea un poco mas allá e intentar <strong>aprender lo máximo posible durante el proceso</strong>.</p>

<h2> Panel de control / Dashboard. </h2>
<p>Mientras programaba la parte del front-end pensaba qué cosas interesantes podría implementar a la página, algo que me facilite el uso y me brinde información de forma sencilla, por lo que se me ocurrio agregar un <strong>DASHBOARD</strong>. Obviamente, no podría permitir que cualquier usuario ingrese al mismo, por lo que debí implementar un <strong>sistema de autenticación</strong>, el cual por suerte laravel, incluye uno bastante fácil de usar.</p>
<img src="https://lh3.googleusercontent.com/d/1A6CbQwr9wENyS72gyElU0FbyAx516-FY=w1000" alt="Captura de pantalla del inicio de sesion">
<br>
<p>Una vez se inicia sesión, se redirige a la página principal la cual ahora tendrá un nuevo botón que <strong>da acceso al panel de control</strong>.</p>
<img src="https://lh3.googleusercontent.com/d/15FwUrtb7zB8L2Tq5RXy5ZYmjn12bMLqC=w1000" alt="Captura de pantalla que muestra el boton activado">
<small>El botón que da acceso al inicio de sesión se muestra en la navbar.</small>

<h3>Estadíticas de la página</h3>
<p>Dentro del panel de control se encuentra un apartado de estadísticas de la página, las cuales podremos <strong>consultar y reiniciar</strong> según necesitemos. En ellas se muestran:</p>
<ul>
<li>Cantidad de <strong>visitas totales</strong> a la página principal.</li>
<li><strong>Cantidad de clicks</strong> (interacciones) en los botones de linkedin y github.</li>
<li><strong>Cantidad de clicks</strong> al botón de contacto.</li>
</ul>

<img src="https://lh3.googleusercontent.com/d/1ndSQISAeuB7XHi-5ZBFZpd3iQ9GUAlKP" alt="Captura del panel de estadísticas">
<img src="https://lh3.googleusercontent.com/d/1xqaldNXRzZTBnD-26oHF30usU8I9i6p6" alt="Captura del popup de confirmacion al querer reiniciar una estadistica">

> Cabe aclarar que estas estadisticas cuentan con un <strong>"Rate limit"</strong>, es decir, si el usuario recarga la página varias veces, la estadística de visitas totales <strong>sólo aumentará una vez</strong> (y así con las demás), esto es para evitar visitas "fantasma".

<h3>Proyectos dinámicos</h3>
<p>En el apartado de <strong> proyectos </strong> se encuentra el listado de mis proyectos (almacenados en una base de datos <strong>MySQL</strong>). Aquí es donde realizo las distintas operaciones con mis proyectos, tales como:</p>
<ul>
<li><strong>Ver</strong> los proyectos</li>
<li><strong>Crear</strong> proyectos</li>
<li><strong>Editar y eliminar</strong> proyectos</li>
</ul>

<img src="https://lh3.googleusercontent.com/d/1PisD2YgieLnzIhygZGQh_k6eWS6y0gDx">

<img src="https://lh3.googleusercontent.com/d/17gb_ADpSVTnUfOLTCUfLzLME2sse-55u">

<img src="https://lh3.googleusercontent.com/d/1aPiGCZQovGxgQ3nnF-2zLsIjV96L3Mj9">

<p>Los formularios cuentan con <strong>validación de datos en el backend</strong>, laravel hace que su aplicación sea muy fácil. También puede verse distintos parámetros interesantes como:</p>
<ul>
<li>Identificación mediante un <strong>slug único</strong></li>
<li><strong>Etiquetas</strong> que se mostrarán en la página principal.</li>
<li>Posibilidad de establecer si el proyecto es <strong>VISIBLE O NO</strong> para el público en la página inicial.</li>
<li>Capacidad de indicar en qué <strong>orden</strong> debe mostrarse el proyecto en la página principal.</li>
</ul>

<img src="https://lh3.googleusercontent.com/d/13aCGkeFAaEqwEjWW1_c5qhT2OXaRyl_3">

<p>Las distintas operaciones se realizan haciendo uso de una <strong>API  REST propia</strong> creada en laravel. Mi API cuenta con rutas <strong>PÚBLICAS y PRIVADAS</strong> (las cuales <strong>necesitan un token JWT para poder ser accedidas</strong>). Esta API es utilizada en toda la página para distintas tareas.</p>

<h3>Resultados</h3>
<p>Gracias a este sistema podemos ver los siguientes resultados: </p>
<img src="https://lh3.googleusercontent.com/d/17Swa3EXa3A69tLvS_rQhoHA23Mp-kieB">
<p>Donde podemos observar cómo se ven los proyectos una vez creados, nótese las <strong>etiquetas en la parte inferior derecha de las imágenes de cada proyecto</strong>, como así también un botón de <strong>ver más</strong> el cual nos redirige a <strong>la página del proyecto</strong> que veremos a continuación. Por último, <strong>si los proyectos son impares</strong> se colocará un "placeholder" con el texto "Más proyectos próximamente" para ocupar el espacio faltante.</p>

<h3>Página del proyecto</h3>
<p>Al dar click en el botón de "ver más" accederemos a la página del proyecto para ver su información detallada. Además es importante destacar que debajo de su imágen podremos ver <strong>sus estadísticas como así también los respectivos enlaces (github y web / los botones se desactivan si no se especificó el link al crear el proyecto)</strong></p>

<img src="https://lh3.googleusercontent.com/d/1dE8Ejd5VhIl-ipdh2lcqq-_Kq8rl6ENi">
