# 📚 BookReview - Plataforma de Reseñas de Libros

He desarrollado BookReview como una plataforma web orientada a los entusiastas de la lectura. El sistema permite a los usuarios explorar un catálogo de obras clasificadas por géneros, consultar las opiniones de otros lectores y publicar reseñas propias con valoraciones de 1 a 5 estrellas. Adicionalmente, he integrado un panel de administración para la monitorización y visualización de estadísticas globales de la plataforma.

El proyecto está construido sobre el stack **VILT**: **V**ue 3 (Composition API), **I**nertia.js, **L**aravel 11 y **T**ailwind CSS (con componentes de DaisyUI).

---

## Arquitectura de Base de Datos y Seeding

He estructurado el modelo de datos relacional en tres entidades principales:
1. **Users:** Gestiona la autenticación del sistema. Incluye un atributo `role` para diferenciar entre el acceso de administración (`admin`) y el de los lectores (`user`).
2. **Books:** Almacena la información de las obras (título, autor, género, descripción y URL de la portada).
3. **Reviews:** Actúa como tabla transaccional vinculando a los usuarios con los libros, registrando la puntuación numérica y el comentario en formato de texto.

**Estrategia de inicialización de datos (Seeding):**
Para garantizar una presentación realista de la interfaz desde el primer despliegue, he prescindido de generadores de texto genérico (*Lorem Ipsum*) para el catálogo. En su lugar, configuré el `DatabaseSeeder.php` para inyectar un array estructurado con libros reales y portadas extraídas de Unsplash. Para la generación de usuarios adicionales y reseñas, sí empleé `Factories`, lo que me permitió disponer de un entorno de pruebas con valoraciones medias operativas de forma inmediata.
El sistema genera por defecto la credencial de administración: `admin@admin.com` / `password`.

---

##  Estructura del Código y Lógica de Negocio

### Backend (Laravel)
* **`BookController.php`:** Centraliza las operaciones principales. Además de gestionar el filtrado de libros por género, he integrado en este controlador el CRUD de las reseñas.
  * Implementé el método `updateOrCreate` de Eloquent, optimizando el código para que un mismo flujo maneje tanto la creación como la actualización de una reseña.
  * Para la eliminación (`destroyReview`), establecí una validación estricta que verifica que el usuario autenticado coincida con el autor del registro antes de proceder con el borrado en la base de datos.
* **`DashboardController.php`:** Procesa las métricas destinadas al panel de control (volumen de usuarios, cantidad de libros, promedio global de valoraciones y el ranking de las 5 obras mejor valoradas).
* **Rutas (`web.php`):** Apliqué una segregación de accesos. La ruta raíz es pública, mientras que las operaciones de consulta de libros, manipulación de reseñas y acceso al panel de administración están protegidas mediante el middleware `auth`, garantizando la seguridad del sistema frente a accesos no autorizados mediante URL.

### Frontend (Vue 3 + Inertia)
* **Páginas Principales:**
  * `Main.vue`: Landing page con renderizado condicional. Presenta un *hero section* a pantalla completa para invitados y despliega el grid de categorías para usuarios autenticados.
  * `Books/Index.vue`: Interfaz del catálogo que renderiza las tarjetas de los libros y gestiona la apertura del modal de interacción.
  * `Admin/Dashboard.vue`: Entorno protegido que renderiza las estadísticas del sistema.
* **Componentes Destacados:**
  * `ReviewModal.vue`: Componente de alta complejidad que gestiona la lectura asíncrona de comentarios y renderiza de forma reactiva el formulario de valoración.

---

## Resoluciones Técnicas Implementadas

### 1. Estado Global de Modales (`provide` / `inject`)
Durante el desarrollo, detecté que instanciar los modales de autenticación exclusivamente en la vista principal rompía la funcionalidad de la barra de navegación en rutas secundarias. Resolví este problema arquitectónico migrando los modales al componente raíz (`Layout.vue`). Mediante la API de composición, el layout expone (`provide`) los métodos de apertura, permitiendo que cualquier componente hijo del árbol de vistas los consuma (`inject`) de forma centralizada y sin duplicidad de código.

### 2. Reactividad en el Ecosistema SPA (`watch`)
Dado el comportamiento de Inertia.js, la aplicación no recarga el navegador al procesar mutaciones en la base de datos. Para asegurar que el modal reflejara las nuevas reseñas de forma instantánea, implementé un observador (`watch`) profundo sobre el objeto de libros. Al detectar que Laravel retorna un nuevo estado tras publicar una reseña, el componente actualiza dinámicamente el libro seleccionado en el DOM sin interrumpir la experiencia de usuario.

