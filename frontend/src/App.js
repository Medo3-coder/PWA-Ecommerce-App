import { Fragment } from 'react';
import { BrowserRouter as Router } from 'react-router-dom';
import AppRoutes from './routes/AppRoutes';

function App() {
  return (
     <Fragment>
         <Router>
           <AppRoutes />
        </Router>
     </Fragment>
  );
}

export default App;
