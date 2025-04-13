from flask import Flask, request, redirect, url_for, render_template, flash
import redis

app = Flask(__name__)

app.secret_key = 'verdefast' 

# Conexión a Redis
cx = redis.Redis(host='localhost', port=6379, decode_responses=True)

@app.route('/', methods=['GET'])
def index():
    return render_template('index.html')  # Página de inicio

@app.route('/registro', methods=['GET', 'POST'])
def registro_usuario():
    if request.method == 'POST':
        # Obtener datos del formulario
        nombre = request.form['nombre']
        apellido = request.form['apellido']
        correo = request.form['correo']
        telefono = request.form['telefono']
        genero = request.form['genero']
        fecha_nacimiento = request.form['fecha_nacimiento']
        domicilio = request.form['domicilio']
        contraseña = request.form['contraseña']

        # Verificar si el correo ya existe en Redis
        if cx.exists(f"usuario:{correo}"):
            flash('El correo ya está registrado. Intenta con otro.', 'error')
            return redirect(url_for('registro_usuario'))

        # Si no existe, guardar en Redis
        cx.hset(f"usuario:{correo}", mapping={
            'nombre': nombre,
            'apellido': apellido,
            'correo': correo,
            'telefono': telefono,
            'genero': genero,
            'fecha_nacimiento': fecha_nacimiento,
            'domicilio': domicilio,
            'contraseña': contraseña,
            'rol':"cliente"
        })

        return redirect(url_for('index'))

    return render_template('registro.html')  # Formulario de registro

@app.route('/login', methods=['POST'])
def login():
    correo = request.form['correo']
    contraseña = request.form['contraseña']

    # Buscar si el usuario existe en Redis
    if cx.exists(f"usuario:{correo}"):
        usuario = cx.hgetall(f"usuario:{correo}")
        contraseña_guardada = usuario.get('contraseña')
        rol_guardado = usuario.get('rol')

        # Verificar la contraseña
        if contraseña == contraseña_guardada and rol_guardado == 'cliente':
            return redirect(url_for('panel_control'))
        else:
            flash('Contraseña incorrecta.', 'error')
            return redirect(url_for('index'))
    else:
        flash('El correo no está registrado.', 'error')
        return redirect(url_for('index'))

@app.route('/sembradio')
def panel_control():
    return render_template('/sembradio.html')  # Página del panel de control

@app.route('/exito')
def registro_exitoso():
    return redirect(url_for('index'))  # Redirige al index tras el registro

if __name__ == '__main__':
    app.run(debug=True)
