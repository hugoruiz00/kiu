<x-app-layout>
  <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">

    <h1 class="text-3xl font-semibold text-center mb-6">Política de Privacidad</h1>
    
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Introducción</h2>
    <p class="mb-4">
      Esta Política de Privacidad describe cómo recopilamos, utilizamos, almacenamos y protegemos la información personal proporcionada por los usuarios que utilizan <a class="text-blue-500" href="{{route('home')}}">colasvirtuales.com</a>.
      Al hacer uso de nuestros servicios, los usuarios aceptan los términos y condiciones establecidos en esta Política de Privacidad. Nos comprometemos a manejar los datos personales de manera responsable, asegurando su uso exclusivo para los fines descritos a continuación.
      Si tienes preguntas o inquietudes sobre cómo gestionamos tu información, puedes contactarnos a través de <a class="text-blue-500" href="{{route('comment.create')}}">La caja de comentarios</a>.
    </p>

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">1. Información Recopilada</h2>
    <div class="pl-6 mb-4">
        Para los usuarios que desean registrarse en la cola de un negocio no se solicita el registro o inicio de sesión en la página por medio de la cuenta de Google, por lo que la única información solicitada a dichos usuarios es su <strong>nombre</strong> por medio de un campo de texto.
        <br><br>
        En la caja de comentarios se permite a los usuarios enviar un comentario para cualquier solicitud, problema o sugerencia y, opcionalmente, pueden agregar un <strong>correo</strong> y <strong>teléfono</strong>.

        <h3 class="text-lg font-semibold mb-2 mt-4">Cómo recolectamos tu información por medio de Google</h3>
        Al iniciar sesión con Google, para los usuarios que desean dar de alta un negocio, se obtiene la siguiente información a través de su cuenta de Google:
            <ul class="list-inside list-disc pl-6">
                <li><strong>Correo electrónico</strong></li>
                <li><strong>Nombre</strong></li>
                <li><strong>ID de usuario de Google</strong></li>
            </ul>
        <br>
        Además, dentro de la página deben completar un formulario con los siguientes datos:
            <ul class="list-inside list-disc pl-6">
                <li><strong>Nombre del negocio</strong></li>
                <li><strong>Tipo de negocio</strong></li>
                <li><strong>Teléfono del negocio (opcional)</strong></li>
                <li><strong>Logo del negocio (opcional)</strong></li>
            </ul>
        
    </div>
  
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">2. Finalidad del Uso de la Información</h2>
    <p class="mb-4">
        - El nombre proporcionado por los usuarios que se registran en la cola de un negocio se utiliza para registrarlos, asignarles un turno y mostrar dicho nombre de manera pública en la cola.<br>
        - El correo y/o teléfono que los usuarios deciden agregar en la caja de comentarios se utiliza para dar seguimiento y poder comunicarse con el usuario sobre su solicitud. <br>
        - El registro de un usuario en la cola de un negocio puede usarse para generar métricas útiles para los negocios sobre la cantidad de clientes atendidos, clientes por día, turnos cancelados, entre otros. <br>
        - La información proporcionada por los usuarios que acceden con una cuenta de Google es utilizada para registrarlos en la página y para poder contactarlos por medio del correo electrónico. <br> 
        - La información que se registra en el formulario es utilizada para mostrar los detalles del negocio en la página, permitiendo que los clientes se registren en la cola, así como para gestionar y administrar los turnos de los clientes (marcar como atendidos o cancelar turnos).
    </p>
  
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">3. Almacenamiento y Protección de Datos</h2>
    <p class="mb-4">
        Los datos personales de clientes y negocios se almacenan en nuestra base de datos en <strong>servidores seguros</strong>, accesibles únicamente por personal autorizado.<br>
    </p>
  
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">4. Acceso, Corrección y Eliminación de Datos</h2>
    <p class="mb-4">
        Los usuarios registrados en la página que cuentan con datos sobre sus negocios tienen la capacidad de <strong>consultar</strong> y <strong>actualizar</strong> dicha información a través del panel de administración de su cuenta y pueden solicitar la <strong>eliminación</strong> de su información de nuestros registros a través de <a class="text-blue-500" href="{{route('comment.create')}}">La caja de comentarios</a>.<br>
    </p>
  
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">5. Compartición de Información</h2>
    <p class="mb-4">
        - <strong>No compartimos</strong> en ningún caso la información personal de los clientes ni de los negocios con terceros.<br>
        - Sin embargo, los <strong>nombres de los clientes</strong> serán visibles públicamente en la cola del negocio al que se han registrado, con el único propósito de gestionar los turnos de manera transparente. <br>
        - Asimismo, con la finalidad de que los usuarios tengan la facilidad registrarse en la cola de un negocio, <strong>el nombre, el logo y el tipo de negocio</strong> se muestran de forma pública.
    </p>

  </div>
  
</x-app-layout>
