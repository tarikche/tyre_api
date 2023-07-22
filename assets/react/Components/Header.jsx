import React from 'react';
import { ShoppingCart } from 'lucide-react';
import { UserCircle2 } from 'lucide-react';
const cartNumber = 1;

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
        <a href="#" class="mr-4  w-28    flex justify-center items-center text-white bg-black rounded-full h-16">
            <ShoppingCart size={40} strokeWidth={4} />
            <span className='ml-3 font-sans font-bold   '>{cartNumber}</span>
        </a>
        <a href="#" class="mr-4 px-5 flex items-center"><UserCircle2 size={47} strokeWidth={3} /><span></span></a>
        </div>
    </div>
</header>

  );
};

export default Header;
