import React from 'react';

const Header = () => {
  return (
    <header class="flex items-center justify-around pl-8 pr-8 pt-8 mb-8 text-4xl ">
    <nav class="flex justify-evenly   w-2/3  ">
        <h4>Home</h4>
        <h4>About</h4>
        <h4>Contact</h4>
        
    </nav>
    <div class='text-center w-1/3 '>
        <h2>_________</h2>
        
    </div>
    <div class="flex justify-end w-2/3  ">
        <div class=' w-1/2 flex justify-evenly'>
            <a href="#" class="mr-4">Cart</a>
            <a href="#">Login</a>
        </div>
    </div>
</header>

  );
};

export default Header;
