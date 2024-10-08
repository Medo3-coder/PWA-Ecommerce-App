import { Fragment } from 'react';
import { BrowserRouter as Router } from 'react-router-dom';
import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import AppRoutes from './routes/AppRoutes';

function App() {
  return (
     <Fragment>
         <Router>
           <AppRoutes />
        </Router>
        <ToastContainer />
     </Fragment>
  );
}

export default App;
