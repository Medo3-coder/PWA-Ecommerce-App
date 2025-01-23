import { Fragment } from 'react';
import { BrowserRouter as Router } from 'react-router-dom';
import { QueryClient, QueryClientProvider } from 'react-query';

import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import AppRoutes from './routes/AppRoutes';


const queryClient = new QueryClient();


function App() {
   return (
      <Fragment>
         {/* Wrap your app with QueryClientProvider and pass the queryClient */}
         <QueryClientProvider client={queryClient}>
            <Router>
               <AppRoutes />
            </Router>
            <ToastContainer />
         </QueryClientProvider>
      </Fragment>
   );
}

export default App;
