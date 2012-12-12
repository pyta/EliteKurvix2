using System;
using System.Collections.Generic;
using System.Linq;
using Microsoft.Xna.Framework;
using Microsoft.Xna.Framework.Audio;
using Microsoft.Xna.Framework.Content;
using Microsoft.Xna.Framework.GamerServices;
using Microsoft.Xna.Framework.Graphics;
using Microsoft.Xna.Framework.Input;
using Microsoft.Xna.Framework.Media;
using GRProjekt.MainMenu;

namespace GRProjekt
{
    public class Game1 : Microsoft.Xna.Framework.Game
    {
        GraphicsDeviceManager graphics;
        SpriteBatch spriteBatch;
        private Menu menu;


        public Game1()
        {
            graphics = new GraphicsDeviceManager(this);
            Content.RootDirectory = "Content";
            IsMouseVisible = true;
        }

        protected override void Initialize()
        {
            menu = new Menu(GraphicsDevice.Viewport.Bounds ,GraphicsDevice.Viewport.AspectRatio);
            base.Initialize();
            
        }

        protected override void LoadContent()
        {
            spriteBatch = new SpriteBatch(GraphicsDevice);
            menu.LoadContent(Content);          
        }


        protected override void UnloadContent()
        {

        }
        protected override void Update(GameTime gameTime)
        {
            if (menu.Update() == true) Exit();

            base.Update(gameTime);
        }
        protected override void Draw(GameTime gameTime)
        {
            GraphicsDevice.Clear(Color.CornflowerBlue);
            //spriteBatch.Begin();
            this.menu.Draw(gameTime, spriteBatch);
            
           // spriteBatch.End();
            base.Draw(gameTime);
        }
    }
}
